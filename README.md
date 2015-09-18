# getoptc
C style getopt for php

[![Latest Stable Version](https://poser.pugx.org/zzengineer/getoptc/v/stable)](https://packagist.org/packages/zzengineer/getoptc) [![Total Downloads](https://poser.pugx.org/zzengineer/getoptc/downloads)](https://packagist.org/packages/zzengineer/getoptc) [![Latest Unstable Version](https://poser.pugx.org/zzengineer/getoptc/v/unstable)](https://packagist.org/packages/zzengineer/getoptc) [![License](https://poser.pugx.org/zzengineer/getoptc/license)](http://opensource.org/licenses/MIT)
---
### NAME
getoptc -- get option character from command line argument list

### SYNOPSIS

`function getoptc($args, $optstring, &$optind, &$optarg, $opterr = true)`

### DESCRIPTION

The **getoptc()** function parses a given command line argument list and returns the next known option character. An option character is *known* if it has been specified in the string of accepted option characters, `$optstring`.

The option string may contain the following elements: individual characters, and characters followed by a colon to indiacte an option argument is to follow. If an individual character is followed by two colons, then the option argument is optional; `$optarg` is set to the rest of the current word. It does not matter to **getoptc()** if a following argument has leading whitespace.

On return from **getoptc()**, `$optarg` is set to an argument if it is anticipated or `NULL` instead. `$optind` contains the index to the next list argument for a subsequent call to ***getoptc()***.

The variable `$optind` is initialized to 1. The `$optind` variable may be set to another value before a set of calls to **getoptc()** in order to skip over more or less list entries.

The variable `$opterr` is intialized to true, and can be disabled to surpress error messages. *see RETURN VALUES*

### RETURN VALUES

The **getoptc()** function returns the next kown option character in `$optstring`. If **getopt()** encounters a character not found in `$optstring` or if it detects a missing option argument, it returns `?` (question mark). If `$optstring` has a leading `:` then a missing optin argument causes `:` to be returned instead of `?`. In either case, the variable `$optarg` is set to the character that caused the error. The **getoptc()** function returns `false` when the argument list is exhausted. `$optind` will contain the index of the first non-option argument. Every subsequent call to **getoptc()** will return `false` and leave `$optind` and `$optarg` untouched.


### EXAMPLES

```php
while (($c =  getoptc($argv,'ab:c::', $optind, $optarg)) !== false)
  switch ($c) {
  case 'a': $flag_a=true; break;
  case 'b': $arg_b=$optarg; break;
  case 'c': $flag_c=true; $arg_c=$optarg; break;
  case '?': 
  case ':': 
  default : usage(); exit(1);
  }
  
for ($i = $optind; $i < count($argv); $i++)
   print "programm argument ". $argv[$i]. PHP_EOL;
```
### DIAGNOSTICS

If the **getoptc()** function encounters a character not found in the string `$optstring` or detects a missing option argument it writes an error messages to `STDERR`. Setting `$opterr` to `false` will disable these error messages.

Option arguments are allowed to begin with `-`; this is reasonable but reduces the amount of error checking possible.

### MISC
