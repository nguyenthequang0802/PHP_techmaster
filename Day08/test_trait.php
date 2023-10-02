<?php
trait Greeting {
    public function sayHello() {
        echo "Hello, ";
    }

    public function sayGoodbye() {
        echo "Goodbye!";
    }
}

trait Welcome {
    public function sayHello() {
        echo "Welcome, ";
    }

    public function sayGoodbye() {
        echo "See you later!";
    }
}

class User {
    use Greeting, Welcome {
        Greeting::sayHello insteadof Welcome;
        Welcome::sayGoodbye insteadof Greeting;
    }
}

$user = new User();
$user->sayHello(); // Output: Hello,
$user->sayGoodbye(); // Output: See you later!