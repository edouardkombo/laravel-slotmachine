#Author
@EdouardKombo


#How to
  - Clone the repository
  
        git clone https://github.com/edouardkombo/laravel-slotmachine

  - Install dependencies
      
        composer install
        
  - Run tests to ensure that everything is working
      
        ./vendor/bin/phpunit
        
  - Run the command
      
        php artisan slot-machine:spin
        

#Introduction

This project is a small and simple slotmachine algorythm written in Php with Laravel Lumen.

Given a json data with Faces, paylines, payouts, number of reels and slots configuration, generate a two dimensional array with shuffled faces and calculate exact payouts matching paylines.

For this exercise, we assume that 1 bet = 100 (1 euro).


  - Given inputs
  
        faces:["9","10","j","q","k","a","cat","dog","monkey","bird"]
        reels: 5 //lines
        slots: 3 //rows
        paylines: [[0,3,6,9,12],[1,4,7,10,13],[2,5,8,11,14],[0,4,8,10,12],[2,4,6,10,14]]
        payouts: 3 symbols = 20% of bet, 4 symbols = 200% of bet, 5 symbols = 1000% of bet
        bet = 100 (1 euro)

  - Expected Multidimensional array
       
        //Array will follow this pattern
        0 3 6 9  12
        1 4 7 10 13
        2 5 8 11 14
           
        Example: board = ['j', 'j', 'j', 'q', 'k', 'cat', 'j', 'q', 'monkey', 'bird', 'bird', 'bird', 'j', 'q', 'a']   
            
        //Array in our example
        j         j            j        q           k
        cat     j           q       monkey  bird
        bird    bird       j        q           a

  - Expected output
      
        {
            board: ['j', 'j', 'j', 'q', 'k', 'cat', 'j', 'q', 'monkey', 'bird', 'bird', 'bird', 'j', 'q', 'a'],
            paylines: [{"0,3,6,9,12": 3}, {"0,4,8,10,12":3}],
            bet_amount: 100,
            total_win: 40
        }
        
        
  - requirements
      
        . We do not focus on any shuffling strategy
        . We do not focus on any winning or loosing probabilities
        . Only end results pattern matter

       
#Architecture behind

A slot machine algorythm should be as generic as possible to run multiple different games.

Following this idea, this tutorial is a game, and all its configurations have been saved in a json file located at "storage/app/storage".

Maybe we would need in a near future, a specfic shuffling strategy to automatically adjust probabilities, and maybe we will also a specific mapping strategy (how to fill in symbols in the 2d array).

This code has been designed with following design patterns:

- Strategy
- CABIN Principle (My own personal principle I invented in 2014)

You can add new different shuffling or mapping strategies without modifying or breaking existing code.

Scalability has been placed at the heart of it.


#Explanation

Everything starts from the contracts "app/Http/Interfaces".

Contracts are implemented by abstract classes "app/Http/Abstracts".

Abstractions extends strategies "app/Http/Strategy".

Common method for shuffle strategies has been written in a trait "app/Http/Traits".

Concrete method just extends main Abstract class "SpinAbstract".

Command calls controller method and display its response.


#TODO

Improve unit tests (too few cases right now).


#Thanks

Thank you for giving me the opportunity to solve this test, I appreciate it.