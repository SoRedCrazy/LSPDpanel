<?php
namespace App\EventSubscriber;

use App\Entity\Agent;
use App\Entity\Citoyen;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\Security\Core\Security;



class EasyAdminSubscriber implements EventSubscriberInterface
{

    private $entityManager;
    private $passwordEncoder;
    private $security;

    public function __construct(Security $security,EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordEncoder)
    {
        $this->security = $security;
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }
 

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['new'],
            BeforeEntityUpdatedEvent::class => ['update'],
        ];
    }

    public function update(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if ($entity instanceof Agent) {
                $this->setPassword($entity);
                return;
        }
        
    }

    public function new(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();
        if($entity instanceof Agent or $entity instanceof Citoyen){
            if($entity instanceof Agent){
                $this->setPassword($entity);
            }
            return;
        }

        $agent = $this->security->getUser();
        $entity->setAgent($agent);
    }

          /**
       * @param User $entity
       */
      public function setPassword(Agent $user): void
      {
          $pass = $user->getPassword();

          $user->setPassword(
            $this->passwordEncoder->hashPassword(
                $user,
                $pass
            )
            );

          $this->entityManager->persist($user);
          $this->entityManager->flush();
      }
}