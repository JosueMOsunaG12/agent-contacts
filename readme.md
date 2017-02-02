<h1 align="center">AGENT CONTACTS powered by </h1>
<br>
<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Agent Contacts

Agent Contacts is a web development with the goal of implement in PHP+Laravel an application that displays the match between 2 actors: the Agents and a list of Contacts. This application split the contact list into 2 groups (1 per agent) based on their zip codes. This intelligent match use just 1 rule “Location”.

## Database Model

To develop this project we designed a data model that contains three main classes:

- Agents, only consists of Id and Name.
- Zipcodes, which contains the Id (the number corresponding to the zipcode), lat (its latitude) and lng (its longitude).
- Contacts, which conforms to the following attributes: Id, Name and Zipcode.

The only existing relationship in database it's found between Zipcodes and Contacts through the Zipcode field that is in Contacts.

## Application Structure

In the application layer of this project you can divide the logic into the following parts.

- Controllers:
    - AgentsController, the controller that receives the user's requests, is responsible for orchestrating all the logic to respond to the user correctly.
- Business:
    - AggentsMapper, is in charge of mapping the input of the agents to obtain a data structure its latitude and corresponding length.
    - ContactsTransformer, responsible for performing all necessary transformations in the contact list to obtain the information of contacts divided by agents.
    - HarvesineCalculator, is in charge to perform the calculations necessary to obtain the distances between two points with their latitude and longitude.
- Repositories: are in charge of preparing the information of the models to be used by the rest of the logic of the application, there is one for each model.
- Models: are used to receive or send the information to the database, there is one for each database table.

## User interface

It consists of a main view with:

- 2 inputs for typing the zip codes for the 2 agents (Agent 1 and Agent 2). 
- A button labeled “MATCH” to trigger the algorithm.
- A table pair with 3 columns (AgentId, Contact Name, Contact Zip Code) with the contacts assigned to each agent.

It was developed in laravel templates, also, a bootstrap template was added to accelerate development.

## Third party tools

- The [wilgucki/csv](https://github.com/wilgucki/csv) package was used to insert the csv in the database through the model.
- The [laravelcollective/html](https://laravelcollective.com/) package was used to create the forms in html.

## Installation and usage

1. Download this repository

2. Run the command `composer install`

3. Run the command `php artisan serve`
