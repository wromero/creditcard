<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Command;

use AppBundle\Command\ValidateCreditCardCommand;
use AppBundle\Utils\Validator;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class ValidCreditCardCommandTest extends KernelTestCase
{
    public function getValidNumbers()
    {
        return array(
            array('42424242424242424242'),
            array('378282246310005'),
            array('371449635398431'),
            array('378734493671000'),
            array('5610591081018250'),
            array('30569309025904'),
            array('38520000023237'),
            array('6011111111111117'),
            array('6011000990139424'),
            array('3530111333300000'),
            array('3566002020360505'),
            array('5555555555554444'),
            array('5105105105105100'),
            array('4111111111111111'),
            array('4012888888881881'),
            array('4222222222222'),
            array('5019717010103742'),
            array('6331101999990016'),
        );
    }

    public function getInvalidNumbers()
    {
        return array(
            array('1234567812345678'),
            array('4222222222222222'),
            array('0000000000000000'),
            array('000000!000000000'),
            array('42-22222222222222'),
        );
    }


    /**
     * @dataProvider getValidNumbers
     *
     * This test provides all the arguments required by the command, so the
     * command runs non-interactively and it won't ask for any argument.
     */
    public function testValidCreditCardNonInteractive($number)
    {

        $this->executeCommand($number);


    }

    /**
     * @dataProvider getInvalidNumbers
     *
     * This test provides all the arguments required by the command, so the
     * command runs non-interactively and it won't ask for any argument.
     */
    public function testInvalidCreditCardNonInteractive($number)
    {

        $this->executeCommand($number);


    }




    /**
     * This helper method abstracts the boilerplate code needed to test the
     * execution of a command.
     *
     * @param  $number The number passed when executing the command
     * @param array $inputs    The (optional) answers given to the command when it asks for the value of the missing arguments
     */
    private function executeCommand( $number, array $inputs = [])
    {
        self::bootKernel();

        $container = self::$kernel->getContainer();
        $command = new ValidateCreditCardCommand();
        $command->setApplication(new Application(self::$kernel));

        $commandTester = new CommandTester($command);
        $commandTester->setInputs($inputs);
        $commandTester->execute(array($number));
    }
}
