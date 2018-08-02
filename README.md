# omnipay-inoviopay
Omnipay driver for InovioPay Gateway

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements PaymentWall support for Omnipay.

[InovioPay](https://www.inoviopay.com/) Inovio is the revolutionary new payments gateway with seamless integration and global scalability that continuously evolves with the industry.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "mvestil/omnipay-inoviopay": "dev-master"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## Basic Usage

The following transactions are provided by this package via the REST API:

* Create a purchase
* Refunding a purchase
* Voiding a purchase
* 3DSecure purchase

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.  There are also examples in the class API documentation.

## Quirks

Card and Token payment is supported. 
In order to create a token payment, customer id (cust_id) and payment id (pmt_id) must be passed.
You can get these values from the response of the first purchase using Card payment.

This package currently supports only single item purchase and multiple items will only be supported in the future release.

For this package to work, you must pass the API credentials as part of the request body including the Product Id (li_prod_id_1) which can be created
in InovioPay portal by creating product with type "Variable Price Product"

## Test modes

The API has only one endpoint which is https://api.inoviopay.com/payment/pmt_service.cfm

## Authentication

To call InovioPay Payments API, reqUsername, reqPassword, siteId, merchAcctId must be passed.
This can be seen in InovioPay admin portal.

## Unit Testing

Tests are not yet included

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.
