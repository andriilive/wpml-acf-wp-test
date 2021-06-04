# Testing WP DB with ACF + WPML setup

**Login & user**: admin

## Useful commands first:

```bash
$ wp post meta list 1
$ wp db export .database/acf-only.mysql
$ wp export --dir=.export/ --post__in=1 --filename_format="post-acf-only.xml" 
$ composer require wpackagist-plugin/*
```

## See also:

`./database` for database exports

`./export` for wp post xml export

[Translate ACF with WPML](https://wpml.org/documentation/related-projects/translate-sites-built-with-acf/)


---

## Post + Empty ACF:

### Post meta with ACF set in admin:

```bash
+---------+------------+--------------+
| post_id | meta_key   | meta_value   |
+---------+------------+--------------+
| 1       | _edit_lock | 1622723931:1 |
+---------+------------+--------------+

```

### Post meta with ACF in Functions:

```bash
+---------+------------+--------------+
| post_id | meta_key   | meta_value   |
+---------+------------+--------------+
| 1       | _edit_lock | 1622723931:1 |
+---------+------------+--------------+

```

---

## Post + Filled up ACF:

```bash
+---------+-------------------+---------------------+
| post_id | meta_key          | meta_value          |
+---------+-------------------+---------------------+
| 1       | _edit_lock        | 1622724768:1        |
| 1       | _edit_last        | 1                   |
| 1       | text              | Text goes here      |
| 1       | _text             | field_60b8c7936d4b2 |
| 1       | Bool              | 1                   |
| 1       | _Bool             | field_60b8c7f008257 |
| 1       | repeater_0_text   | First row text      |
| 1       | _repeater_0_text  | field_60b8c81f08259 |
| 1       | repeater_0_image  | 11                  |
| 1       | _repeater_0_image | field_60b8c8300825a |
| 1       | repeater          | 2                   |
| 1       | _repeater         | field_60b8c7f708258 |
| 1       | repeater_1_text   | Second row text     |
| 1       | _repeater_1_text  | field_60b8c81f08259 |
| 1       | repeater_1_image  | 14                  |
| 1       | _repeater_1_image | field_60b8c8300825a |
+---------+-------------------+---------------------+
```

## Post ACF + Core WPML

### Field Groups (acf-field-group) set to Not translatable:

#### Post has no translations:

```bash
+---------+-----------------------+---------------------+
| post_id | meta_key              | meta_value          |
+---------+-----------------------+---------------------+
| 1       | _edit_lock            | 1622724883:1        |
| 1       | _edit_last            | 1                   |
| 1       | text                  | Text goes here      |
| 1       | _text                 | field_60b8c7936d4b2 |
| 1       | Bool                  | 1                   |
| 1       | _Bool                 | field_60b8c7f008257 |
| 1       | repeater_0_text       | First row text      |
| 1       | _repeater_0_text      | field_60b8c81f08259 |
| 1       | repeater_0_image      | 11                  |
| 1       | _repeater_0_image     | field_60b8c8300825a |
| 1       | repeater              | 2                   |
| 1       | _repeater             | field_60b8c7f708258 |
| 1       | repeater_1_text       | Second row text     |
| 1       | _repeater_1_text      | field_60b8c81f08259 |
| 1       | repeater_1_image      | 14                  |
| 1       | _repeater_1_image     | field_60b8c8300825a |
| 1       | _wpml_media_duplicate | 1                   |
+---------+-----------------------+---------------------+
```

#### Post has 1 translation



```bash
# The original post:

+---------+-----------------------+---------------------+
| post_id | meta_key              | meta_value          |
+---------+-----------------------+---------------------+
| 1       | _edit_lock            | 1622724883:1        |
| 1       | _edit_last            | 1                   |
| 1       | text                  | Text goes here      |
| 1       | _text                 | field_60b8c7936d4b2 |
| 1       | Bool                  | 1                   |
| 1       | _Bool                 | field_60b8c7f008257 |
| 1       | repeater_0_text       | First row text      |
| 1       | _repeater_0_text      | field_60b8c81f08259 |
| 1       | repeater_0_image      | 11                  |
| 1       | _repeater_0_image     | field_60b8c8300825a |
| 1       | repeater              | 2                   |
| 1       | _repeater             | field_60b8c7f708258 |
| 1       | repeater_1_text       | Second row text     |
| 1       | _repeater_1_text      | field_60b8c81f08259 |
| 1       | repeater_1_image      | 14                  |
| 1       | _repeater_1_image     | field_60b8c8300825a |
| 1       | _wpml_media_duplicate | 1                   |
+---------+-----------------------+---------------------+

# The translated post with no data (Created with just +)

+---------+-----------------------+---------------------+
| post_id | meta_key              | meta_value          |
+---------+-----------------------+---------------------+
| 37      | _edit_lock            | 1622726632:1        |
| 37      | _edit_last            | 1                   |
| 37      | text                  |                     |
| 37      | _text                 | field_60b8c7936d4b2 |
| 37      | Bool                  | 0                   |
| 37      | _Bool                 | field_60b8c7f008257 |
| 37      | repeater              |                     |
| 37      | _repeater             | field_60b8c7f708258 |
| 37      | _wpml_media_duplicate | 1                   |
| 37      | _wpml_media_featured  | 0                   |
+---------+-----------------------+---------------------+

# The translated post (Created with just +) filled up with data

+---------+-----------------------+---------------------+
| post_id | meta_key              | meta_value          |
+---------+-----------------------+---------------------+
| 37      | _edit_lock            | 1622726754:1        |
| 37      | _edit_last            | 1                   |
| 37      | text                  | Text (translated)   |
| 37      | _text                 | field_60b8c7936d4b2 |
| 37      | Bool                  | 1                   |
| 37      | _Bool                 | field_60b8c7f008257 |
| 37      | repeater              | 1                   |
| 37      | _repeater             | field_60b8c7f708258 |
| 37      | _wpml_media_duplicate | 1                   |
| 37      | _wpml_media_featured  | 0                   |
| 37      | repeater_0_text       | Row 1 (translated)  |
| 37      | _repeater_0_text      | field_60b8c81f08259 |
| 37      | repeater_0_image      |                     |
| 37      | _repeater_0_image     | field_60b8c8300825a |
+---------+-----------------------+---------------------+

# The translated post created with duplicate option

+---------+------------------------+---------------------+
| post_id | meta_key               | meta_value          |
+---------+------------------------+---------------------+
| 45      | text                   | Text                |
| 45      | _text                  | field_60b8c7936d4b2 |
| 45      | Bool                   | 1                   |
| 45      | _Bool                  | field_60b8c7f008257 |
| 45      | repeater_0_text        | Row 1 text (eng)    |
| 45      | _repeater_0_text       | field_60b8c81f08259 |
| 45      | repeater_0_image       | 14                  |
| 45      | _repeater_0_image      | field_60b8c8300825a |
| 45      | repeater               | 1                   |
| 45      | _repeater              | field_60b8c7f708258 |
| 45      | _wpml_media_duplicate  | 1                   |
| 45      | _wpml_media_featured   | 1                   |
| 45      | _icl_lang_duplicate_of | 41                  |
| 45      | _edit_lock             | 1622726935:1        |
+---------+------------------------+---------------------+
```

### Field Groups (acf-field-group) set Translatable - use translation if available or fallback to default language



