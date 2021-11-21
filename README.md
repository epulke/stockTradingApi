## About StockTrader API

StockTrader API is an application that gives the abbility to register on a website, add funds and trage in US market stock exchange.

Stock trading functionallity is enusred using [Finnhub Stock API](https://finnhub.io/).

## Getting Started

To start using the API download all the package contents and open the project in your local repository.

Create your own .env file based on the [.env.example](https://github.com/epulke/stockTradingApi/blob/main/.env.example) file.

Change database information and Finnhub Key. If necessary, change mail information to [Mailtrap](https://mailtrap.io/) for testing purposes, or any other information.

Run: 

<code>php artisan key:generate</code>

Run all the migrations.

Run the server.

## What Do You Get

When opening this API you will get possibility to register a user, login a user.

Each user is able to see his dashboard, invest funds (no payment methods added yet), search stocks in US market, buy/sell stocks in the stock market working time.

User can see his portfolio and transaction history.



