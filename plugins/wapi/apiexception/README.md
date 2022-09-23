# Api

## Description
Implement API standard to OCMS

## Installation
1. Copy files to `plugins/wapi/apiexception` directory
    - Via git submodules
        ```bash
        git submodule add https://gitlab.com/wezeo/ocms-private-plugins/wapi/apiexception.git plugins/wezeo/apiexception
        ```
    - Via git clone
        ```bash
        git clone https://gitlab.com/wezeo/ocms-private-plugins/wapi/apiexception.git plugins/wapi/apiexception
        ```
2. Add ApiExceptionMiddleware to your api routes

## Usage
- Usage of ApiExceptionMiddleware
  ```php
  Route::group(['prefix' => 'api/v1', 'middleware' => [ApiExceptionMiddleware::class]], function () {
      ...
  });
  
  Example of error response:
  {
    "error": "Order not found",
    "statusCode": 404
  }
  ```
- Usage of ApiResponse trait
  ```php
  class OrdersController extends Controller
  {
      use ApiResponse;
        
      ...
  }
  
  Example of success response:
  {
      "data": [],
      "statusCode": 200
  }
  ```