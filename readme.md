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

The only existing relationship in database it's found between Zipcodes and Contacts through the Zipcode field that is in Contacts

## Third party tools

- The [wilgucki/csv](https://github.com/wilgucki/csv) package was used to insert the csv in the database through the model.
