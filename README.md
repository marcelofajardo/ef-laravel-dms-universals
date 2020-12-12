# 8fold Laravel DMS Universals

> WARNING: This library is primarily used for 8fold-specific projects (indicated by the `ef` prefix).

A library for working with the flat-file [.DMS](Document Management System) used on most 8fold and 8fold-client sites using Laravel.

The fundamental philosophy is that flat-files (usually markdown) primarily store content with minimal metadata while traditional database primarily store metadata with minimal content (specifically relationships).

Because we use a flat-file approach, folder stucture is important; however, the root file system path can be overridden in most cases.

## Installation

```bash
composer require 8fold/ef-dms-laravel-universals
```

## Usage

We divide content into three major groups:

1. text-based,
2. multimedia, and
3. site assets.

Note: If it is not stated as a requirement, chances are whatever it is in the examples, is optional.

The following is an example content folder structure:

```bash
- /content-folder
  - /.assets
    - /favicons
      - favicon.ico
  - /.media
    - poster.png
  - content.md
```

The content folder acts as the root directory; `content.md` files represent the index content for the url.

The `.assets` and `.media` folders hold multimedia files.

The `.assets` folder is for multimedia that is accessed by multiple pages of the site while the `.media` folder is for multimedia elements related to a primary url.

The `.media` subfolder structure follows that of the content folder itself.

A sample Laravel provider and content folder are available in the `tests` folder.

### Site tracking

> If you choose to use the site tracking solution offered by the DMS, you agree to absolve 8fold and its developers of all responsibility and liability related to compliance with applicable data privacy laws.

With that out of the way, the site tracker:

- DOES NOT store personal information of the user.
- DOES store certain aspects of server state and client request:
	- current server date and time in [.UTC](universal time code),
	- current requested path, and
	- previously requested path.
- DOES use standard list of automated users (bots) to differentiate human users from computer users.
- WILL hash (scramble) an unique identifier provided by the user of the script to further conceal the identity of the human user, their client information, and their user agent.

It is recommended that the unique identifier passed to the site tracker is a server-generated session identifier modified with [salt](https://en.wikipedia.org/wiki/Salt_(cryptography)) and [pepper](https://en.wikipedia.org/wiki/Pepper_(cryptography)). To distinguish the session id passed to the site tracker from the one stored on the client and server to identify the same user across multiple pages.

## Details

It's helps with:

- title generation,
- social media sharing metadata and tags, and
- nudging creators to create assets for a full web experience.

## Other

{links or descriptions or license, versioning, and governance}