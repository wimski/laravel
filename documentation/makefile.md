# Makefile Commands

## Setup

```bash
$ make setup
```

If you want start from scratch again use:

```bash
$ make fresh
```

## Docker

When you are setup, use the following commands to manage your existing setup.

### Up

```bash
$ make up
```

### Down

```bash
$ make down
```

If you also want to remove the volumes use:

```bash
$ make destroy
```

## Code Quality

### Tests

```bash
$ make test
```

### PHPCS

```bash
$ make phpcs
```

**Options**

* `path={value}`
  By default all PHP files in the project will be scanned. Supply a path relative to the project's root directory as the value to scan a particular file or folder.

* `fix={value}`
  By default PHPCS will not automatically fix anything. If `fix` is present, it will auto-fix whatever is possible. The value does not matter, so something as `fix=1` will work.
  
* `notices={value}`
  By default PHPCS will not show notices such as _"Line exceeds X characters"_. If `notices` is present, these message will show. The value does not matter, so something as `notices=1` will work.

## Utilities

### IDE Helper

Re-write model doc blocks.

```bash
$ make ide-helper
```
