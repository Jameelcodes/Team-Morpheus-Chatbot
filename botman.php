<?php

require_once 'vendor/autoload.php';

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\SymfonyCache;
use BotMan\BotMan\Drivers\DriverManager;

require_once('OnboardingConversation.php');

$config = [];

DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

$adapter = new FilesystemAdapter();

$botman = BotManFactory::create($config, new SymfonyCache($adapter));

$botman->hears('keyword', function($bot){
	$bot->reply('Hello my friend');
});
$botman->hears('Hello', function($bot){
	$bot->reply('Hi my name is Morph, What is your name?');
});
$botman->hears('my name is {name}', function($bot, $name){
	$bot->reply('Nice meeting you '. $name);
});
$botman->hears('tell me more', function($bot){
	$bot->reply('what do you want to know from me?');
});


//$botman->hears('Hello', function($bot) {
    
  //  $bot->startConversation(new OnboardingConversation);
    /*
});
*/
$botman->listen();