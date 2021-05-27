<?php


namespace Gusnod\MqDemo\Command;



use Gusnod\MqDemo\QueueInterface;
use Gusnod\MqDemo\TimeQueue\Consumer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConversionConsumer extends Command
{
    public function __construct(
        private Consumer $consumer
    ){
        parent::__construct(null);
    }

    protected function configure()
    {
        $this->setName("consumer");
        $this->setDescription("Process conversion messages");
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->consumer->processConversions(function (string $feedback) use ($output) {
            $output->writeln($feedback);
        });
        return 0;
    }
}