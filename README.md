# Super Simple Image Resizer

I was in need of an image reiszer, that handles hundrets of files, that are bigger than 500MB each. I could find an online service, that matched my requirements, nor anything that was fast enough, so I wrote this simple image resizer myself.

## Installation

This requries the `GD` php extension to work. You can just enable it in the php.ini file.

```ini
extension=gd
```

## Usage

1. paste your images into the `source` folder
2. call the index.php file
3. alle resized images appear in the `destination` folder
4. if it stopps without finishing all files, cause the maximum execution time is reached, it says at what file it stopped
5. you can do it repeatedly

## Settings

in `index.php` change the ratio variable
```php
$ratio = 0.5; // -> apply 50% to with and height of image
```

```php
$ratio = 0.7; // -> apply 70% to with and height of image
```
