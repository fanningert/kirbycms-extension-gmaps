# KirbyText Extension - GMaps

This is a Kirbytag to integrate Google Maps API in your website

## Installation

### GIT

Go into the `{kirby_installation}/site/plugins` directory and execute following command.

```bash
$ git clone https://github.com/fanningert/kirbycms-extension-webhelper.git
$ git clone https://github.com/fanningert/kirbycms-extension-gmaps.git
```

### GIT submodule

Go in the root directory of your git repository and execute following command to add the repository as submodule to your GIT repository.

```bash
$ git submodule add https://github.com/fanningert/kirbycms-extension-webhelper.git ./site/plugins/kirbycms-extension-webhelper
$ git submodule add https://github.com/fanningert/kirbycms-extension-gmaps.git ./site/plugins/kirbycms-extension-gmaps
$ git submodule update --init --recursive
$ git submodule foreach --recursive git pull
```

### Manuell

## Update

### GIT

Go into the `{kirby_installation}/site/plugins/kirbycms-extension-gmaps` directory and execute following command.

```bash
$ git pull
```
Don't forget to update the requirement `kirbycms-extension-webhelper`.

### GIT submodule

Go in the root directory of your git repository and execute following command to update the submodule of this extension.

```bash
$ git submodule update --init --recursive
$ git submodule foreach --recursive git pull
```