# Prime Caches WP-CLI

This is a simple WP-CLI command useful when performing migrations. Sometimes it's necessary to pre-prime caches prior to a DNS switch so that database or cache thrash can be limited when real traffic starts hitting a site.
 
 This is your friend.
 
## Getting Started

Clone this repo as a WordPress plugin and run `composer update` inside the directory. This will build all the requirements and dependencies necessary to use the command.

*In the future, I'll be adding this as a WP CLI package*

### Prerequisites

* PHP 5.4+
* WordPress 4.6+

### Usage

Once installed as a WordPress plugin, use the command:

```
wp tspc-cache prime
```

If you want to prime a page other than the home page:

```
wp tspc-cache prime --url=http://example.com/foobar
```

If you want to run the cache prime against a Multisite subsite:

```
wp tspc-cache prime --blog_id=8
```

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
