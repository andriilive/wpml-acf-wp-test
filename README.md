# Testing WP DB with ACF + WPML setup

**Login & user**: admin

Useful commands first:

```bash
$ wp post meta list 1
$ wp db export .database/acf-only.mysql
$ wp export --dir=.export/ --post__in=1 --filename_format="post-acf-only.xml" 
```

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