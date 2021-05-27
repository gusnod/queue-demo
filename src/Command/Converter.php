<?php


namespace Gusnod\MqDemo\Command;


use Gusnod\MqDemo\Data\ConversionMessage;
use Gusnod\MqDemo\QueueInterface;
use Gusnod\MqDemo\TimeQueue\Publisher;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Converter extends Command
{
    public function __construct(
        private Publisher $publisher
    )
    {
        parent::__construct(null);
    }

    protected function configure()
    {
        $this->setName("convert")
            ->addArgument(
                "value",
                InputArgument::REQUIRED,
                "Number to convert"
            )
            ->addArgument(
                "from",
                InputArgument::REQUIRED,
                "Format to convert from"
            )
            ->addArgument(
                "to",
                InputArgument::REQUIRED,
                "Format to convert to"
            )->addArgument(
                "replyqueue",
                InputArgument::REQUIRED,
                "Which queue to post the reply"
            );

        $this->setDescription("Convert a timestamp from one format to another");
    }



    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $number = (int)$input->getArgument("value");
        $from = $input->getArgument("from");
        $to = $input->getArgument("to");
        $replyQueue = $input->getArgument("replyqueue");
        $message = new ConversionMessage($number, $from, $to, $replyQueue);

        $reply = $this->publisher->convert($message);

        $table = new Table($output);
        $table->setHeaders(["Result", "Value", "From", "To"]);
        $table->addRow([$reply->getResult(), $reply->getValue(), $reply->getFrom(), $reply->getTo()]);
        $table->render();
        return 0;
    }
}