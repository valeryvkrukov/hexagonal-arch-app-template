<?php

namespace App\Customer\Controller;

use App\Controller\ControllerResponseTrait;
use App\Customer\Message\Command\ActivateCustomerCommand;
use App\Customer\Message\Command\ChangeCustomerTypeCommand;
use App\Customer\Message\Command\DeactivateCustomerCommand;
use App\Customer\Message\Query\GetCustomerListQuery;
use App\Customer\Message\Query\GetCustomerQuery;
use App\Customer\Security\CustomerVoter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route("/customers")]
final class CustomerController extends AbstractController
{
    use ControllerResponseTrait;

    /**
     * @var MessageBusInterface
     */
    private MessageBusInterface $queryBus;

    /**
     * @var MessageBusInterface
     */
    private MessageBusInterface $commandBus;

    /**
     * @param MessageBusInterface $queryBus
     * @param MessageBusInterface $commandBus
     * @param SerializerInterface $serializer
     */
    public function __construct(
        MessageBusInterface $queryBus,
        MessageBusInterface $commandBus,
        SerializerInterface $serializer
    ) {
        $this->queryBus = $queryBus;
        $this->commandBus = $commandBus;
        $this->serializer = $serializer;
    }

    /**
     * @param GetCustomerQuery $query
     * @return Response
     */
    #[Route("/{id}", requirements: ["id" => "\d+"], methods: ["GET"])]
    public function getAction(GetCustomerQuery $query): Response
    {
        $this->isGranted(CustomerVoter::VIEW);
        $envelope = $this->queryBus->dispatch($query);

        return $this->createJsonResponseFromEnvelope($envelope);
    }

    /**
     * @param GetCustomerListQuery $query
     * @return Response
     */
    #[Route("", methods: ["GET"])]
    public function getListAction(GetCustomerListQuery $query): Response
    {
        $this->isGranted(CustomerVoter::LIST);
        $envelope = $this->queryBus->dispatch($query);

        return $this->createJsonResponseFromEnvelope($envelope);
    }

    /**
     * @param ActivateCustomerCommand $command
     * @return Response
     */
    #[Route("/{id}/activate", requirements: ["id" => "\d+"], methods: ["POST"])]
    public function activateAction(ActivateCustomerCommand $command): Response
    {
        $this->isGranted(CustomerVoter::ACTIVATE);
        $envelope = $this->commandBus->dispatch($command);

        return $this->createJsonResponseFromEnvelope($envelope);
    }

    /**
     * @param DeactivateCustomerCommand $command
     * @return Response
     */
    #[Route("/{id}/deactivate", requirements: ["id" => "\d+"], methods: ["POST"])]
    public function deactivateAction(DeactivateCustomerCommand $command): Response
    {
        $this->isGranted(CustomerVoter::DEACTIVATE);
        $envelope = $this->commandBus->dispatch($command);

        return $this->createJsonResponseFromEnvelope($envelope);
    }

    /**
     * @param ChangeCustomerTypeCommand $command
     * @return Response
     */
    #[Route("/{id}/change-type", requirements: ["id" => "\d+"], methods: ["POST"])]
    public function changeTypeAction(ChangeCustomerTypeCommand $command): Response
    {
        $this->isGranted(CustomerVoter::CHANGE_ROLE);
        $envelope = $this->commandBus->dispatch($command);

        return $this->createJsonResponseFromEnvelope($envelope);
    }
}