<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Post;
use App\Entity\RestaurantPlaces;
use App\Entity\RestaurantRule;
use App\Entity\Schedules;
use App\Form\BookType;
use App\Form\PostType;
use App\Form\RestaurantRuleType;
use App\Form\ScheduleType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class PostController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/', name: 'home')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Post::class);
        $posts = $repository->findAll(); // SELECT * FROM `post`;

        $repositorySchedules = $doctrine->getRepository(Schedules::class);
        $schedules = $repositorySchedules->findAll(); // SELECT * FROM `restaurant_hours`;

        $repositoryBook = $doctrine->getRepository(Book::class);
        $books = $repositoryBook->findAll(); // SELECT * FROM `restaurant_bookings`;

        $repositoryRule = $doctrine->getRepository(RestaurantRule::class);
        $rules = $repositoryRule->findAll(); // SELECT * FROM `restaurant_rule`;
        $restaurantLastRule = $repositoryRule->findLastRuleSubmitted();

        $repositoryPlaces = $doctrine->getRepository(RestaurantPlaces::class);
        $restaurantPlaces = $repositoryPlaces->findAll();
        $restaurantLastPlace = $repositoryPlaces->findLastDateSubmit();

        $book = new Book();
        $form = $this->createForm(BookType::class, $book);

        // Counters for limit Booking

        $countSubmit = 1;

        // ARRAY to load DATA in Front side

        $endBookings[] = null;

        $arrayDays[] = 0;

        $arrayNights[] = 0;

        $endBookingsDay[] = null;

        $endBookingsNight[] = null;

        // Set Limit of Booking per Day
        foreach ($restaurantPlaces as $key => $value)
        {
            if ($value->getNumberOfSubmit() === $value->getNumberOfPlacesMax())
            {
                $endBookings[] = $value->getActiveDate();
            }
        }

        // Set Limit of Booking per Run (Run Day, Run Night)
        foreach ($restaurantPlaces as $key => $value)
        {
            if ($value->getActiveHour() === "Day")
            {
                $datesDays = $value->getActiveDate();
                array_push($arrayDays, $datesDays);
            }
            if ($value->getActiveHour() === "Night")
            {
                $datesNights = $value->getActiveDate();
                array_push($arrayNights, $datesNights);
            }
        }

        // Count EachTime a value Day or Night has been created per days
        $arrayDaysCounted = array_count_values($arrayDays);
        $arrayNightsCounted = array_count_values($arrayNights);

        // Set the limit in Front side
        if ($restaurantLastPlace !== null)
        {
            foreach ($arrayDaysCounted as $key => $value)
            {
                if ($value === $restaurantLastPlace->getNumberOfPlacesMax()/2)
                {
                    $endBookingsDay[] = $key;
                }
            }
        }

        // Set the limit in Front side
        if ($restaurantLastPlace !== null)
        {
            foreach ($arrayNightsCounted as $key => $value)
            {
                if ($value === $restaurantLastPlace->getNumberOfPlacesMax()/2)
                {
                    $endBookingsNight[] = $key;
                }
            }
        }

        $user =$this->getUser();
        $book->setCustomer($user);
        if ($this->isGranted('ROLE_USER'))
        {
            // Set preferences for Customer connected
            $form["alias"]->setData($user->getAlias());
            $form["phoneNumber"]->setData($user->getPhoneNumber());
            $form["allergies"]->setData($user->getAllergies());
            $form["preferedGroupNumber"]->setData($user->getPreferedGroupNumber());
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $places = new RestaurantPlaces();

            // Set Max by Admin Rule

            if ($restaurantLastRule->getBookingLimit() !== null)
            {
                $places->setNumberOfPlacesMax($restaurantLastRule->getBookingLimit());
            }

            if ($form["hourSelectedDay"]->getData() === null)
            {
                $places->setActiveDate($form["date"]->getData());
                $places->setActiveHour("Night");
                $places->setNumberOfSubmit($countSubmit);
                // Count the number of submit and set it to the new object
                foreach ($restaurantPlaces as $key => $value)
                {
                    if ($value->getActiveDate() === $places->getActiveDate())
                    {
                        $countSubmit++;
                    }
                }
                $places->setNumberOfSubmit($countSubmit);
            }

            if ($form["hourSelectedNight"]->getData() === null)
            {
                $places->setActiveDate($form["date"]->getData());
                $places->setActiveHour("Day");
                foreach ($restaurantPlaces as $key => $value)
                {
                    if ($value->getActiveDate() === $places->getActiveDate())
                    {
                        $countSubmit++;
                    }
                }
                $places->setNumberOfSubmit($countSubmit);
            }

            $em = $doctrine->getManager();
            $em->persist($book);
            if ($places->getActiveDate() !== null)
            {
                $places->setBook($book);
                $em->persist($places);
            }
            $em->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('base.html.twig', [
            "posts" => $posts,
            "schedules" => $schedules,
            "books" => $books,
            "rules" => $rules,
            "end_bookings" => $endBookings,
            "end_bookings_day" => $endBookingsDay,
            "end_bookings_night" => $endBookingsNight,
            'book_form' => $form->createView()
        ]);
    }

    #[Route('/post/new')]
    public function create(Request $request, ManagerRegistry $doctrine, SluggerInterface $slugger): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $imageFile = $form->get("image")->getData();

            if ($imageFile)
            {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter("uploads"),
                        $newFilename
                    );
                } catch (FileException $e) {
                    //
                }

                $post->setImage($newFilename);
            }

            $em = $doctrine->getManager();
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('post/form.html.twig', [
            'post_form' => $form->createView()
        ]);
    }

    #[Route('/post/edit/{id}', name: "edit-post", requirements: ["id" => "\d+"])]
    public function update(Post $post, ManagerRegistry $doctrine, Request $request, SluggerInterface $slugger): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $imageFile = $form->get("image")->getData();

            if ($imageFile)
            {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter("uploads"),
                        $newFilename
                    );
                } catch (FileException $e) {
                    //
                }

                $post->setImage($newFilename);
            }

            $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('post/form.html.twig', [
            'post_form' => $form->createView()
        ]);
    }

    #[Route('/post/delete/{id}', name: "delete-post", requirements: ["id" => "\d+"])]
    public function delete(Post $post, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $em = $doctrine->getManager();
        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('home');
    }

    #[Route('/post/copy/{id}', name: "copy-post", requirements: ["id" => "\d+"])]
    public function duplicate(Post $post, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $copyPost = clone $post;

        $em = $doctrine->getManager();
        $em->persist($copyPost);
        $em->flush();
        return $this->redirectToRoute('home');
    }

    #[Route('/schedules/new')]
    public function createSchedule(Request $request, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $schedules = new Schedules();
        $form = $this->createForm(ScheduleType::class, $schedules);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $doctrine->getManager();
            $em->persist($schedules);
            $em->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('schedules/form.html.twig', [
            'schedules_form' => $form->createView()
        ]);
    }

    #[Route('/schedule/edit/{id}', name: "edit-schedule", requirements: ["id" => "\d+"])]
    public function updateSchedule(Schedules $schedules, ManagerRegistry $doctrine, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $form = $this->createForm(ScheduleType::class, $schedules);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('schedules/form.html.twig', [
            'schedules_form' => $form->createView()
        ]);
    }

    #[Route('/schedule/delete/{id}', name: "delete-schedule", requirements: ["id" => "\d+"])]
    public function deleteSchedule(Schedules $schedules, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $em = $doctrine->getManager();
        $em->remove($schedules);
        $em->flush();

        return $this->redirectToRoute('home');
    }

    #[Route('/booking', name: 'booking')]
    public function indexBook(Request $request, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $repository = $doctrine->getRepository(Book::class);
        $books = $repository->findAll(); // SELECT * FROM `restaurant_bookings`;

        $repositoryRule = $doctrine->getRepository(RestaurantRule::class);
        $rules = $repositoryRule->findAll(); // SELECT * FROM `restaurant_rule`;

        $restaurantRule = new RestaurantRule();
        $form = $this->createForm(RestaurantRuleType::class, $restaurantRule);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $doctrine->getManager();
            $em->persist($restaurantRule);
            $em->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('booking/index.html.twig', [
            "books" => $books,
            "rules" => $rules,
            "restaurantRule_form" => $form->createView()
        ]);
    }

    #[Route('/booking/delete/{id}', name: "delete-booking", requirements: ["id" => "\d+"])]
    public function deleteBook(Book $book, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $repository = $doctrine->getRepository(RestaurantPlaces::class);
        $place = $repository->findOneBy(array('book' => $book->getId())); // SELECT the data with the value id in table `restaurant_places`;
        $em = $doctrine->getManager();
        $em->remove($book);
        $em->remove($place);
        $em->flush();

        return $this->redirectToRoute('booking');
    }

    #[Route('/booking/editRule/{id}', name: "edit-rule", requirements: ["id" => "\d+"])]
    public function updateRule(RestaurantRule $restaurantRule, ManagerRegistry $doctrine, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $repositoryRule = $doctrine->getRepository(RestaurantRule::class);
        $rules = $repositoryRule->findAll(); // SELECT * FROM `restaurant_rule`;

        $repository = $doctrine->getRepository(Book::class);
        $books = $repository->findAll(); // SELECT * FROM `restaurant_bookings`;

        $form = $this->createForm(RestaurantRuleType::class, $restaurantRule);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('booking/index.html.twig', [
            'rules' => $rules,
            'books' => $books,
            'restaurantRule_form' => $form->createView()
        ]);
    }

    #[Route('/booking/deleteRule/{id}', name: "delete-rule", requirements: ["id" => "\d+"])]
    public function deleteRule(RestaurantRule $rule, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $em = $doctrine->getManager();
        $em->remove($rule);
        $em->flush();

        return $this->redirectToRoute('booking');
    }
}
