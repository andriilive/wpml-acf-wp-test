# Testing WP DB with ACF + WPML setup

Useful commands first:

```bash
$ wp post meta list 22339
```

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

## Post + Filled up ACF:

