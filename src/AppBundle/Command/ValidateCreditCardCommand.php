<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ValidateCreditCardCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('stackbuilders:validate')
            ->setDescription('Validation algorithm for a 16 digit number simulating a credit card number. ')
            ->addArgument(
                'number',
                InputArgument::OPTIONAL,
                'Number to validate'
            )
        ;
    }

    /*This es a simple implementation of the Luhn algorithm.
    * It expects a number and evaluates the number agains the algorithm.
    * It returns a message whether it is a valid credit card number or not
    */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $number = $input->getArgument('number');
        if ($number) {
            $sum = 0;
            $nDigits = strlen($number);
            $parity = $nDigits % 2;
            for ($i =0; $i< $nDigits; $i++) {
                $digit = (int)$number[$i];
                if ($i % 2 == $parity)
                    $digit = $digit * 2;
                if ($digit > 9)
                    $digit = $digit - 9;
                $sum = $sum + $digit;
            }
            $text =(($sum % 10) == 0)?$number." is a valid credit card number.":$number." is not valid credit card number.";

        } else {
            $text = 'Number is required to validate';
        }



        $output->writeln($text);
    }
}