<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\ExternalId
 *
 * @property int $id
 * @property string $name
 * @property string $external_id
 * @property int $movie_id
 * @property-read \App\Models\Movie $movie
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExternalId newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExternalId newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExternalId query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExternalId whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExternalId whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExternalId whereMovieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExternalId whereName($value)
 */
	class ExternalId extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Movie
 *
 * @property int $id
 * @property string $title
 * @property string $original_title
 * @property string|null $year
 * @property string $slug
 * @property string $category
 * @property string $genre
 * @property string $description
 * @property string $original_description
 * @property string|null $poster_path
 * @property string|null $backdrop_path
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ExternalId[] $externalIds
 * @property-read int|null $external_ids_count
 * @property-read mixed $average_rating
 * @property-read mixed $imdb_link
 * @property-read mixed $last_rating
 * @property-read mixed $watch_later
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Thread[] $threads
 * @property-read int|null $threads_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WatchLater[] $watchLaters
 * @property-read int|null $watch_laters_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Movie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Movie newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Movie onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Movie query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Movie whereBackdropPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Movie whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Movie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Movie whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Movie whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Movie whereGenre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Movie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Movie whereOriginalDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Movie whereOriginalTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Movie wherePosterPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Movie whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Movie whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Movie whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Movie whereYear($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Movie withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Movie withoutTrashed()
 */
	class Movie extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $post
 * @property int $thread_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post wherePost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereThreadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post withoutTrashed()
 */
	class Post extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string|null $username
 * @property string|null $password
 * @property string $email
 * @property string $avatar
 * @property string|null $theme
 * @property string|null $provider
 * @property string $provider_id
 * @property string|null $access_token
 * @property string|null $remember_token
 * @property string $last_login_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $posts
 * @property-read int|null $posts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Thread[] $threads
 * @property-read int|null $threads_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WatchLater[] $watchLaters
 * @property-read int|null $watch_laters_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLastLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUsername($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Thread
 *
 * @property int $id
 * @property string|null $rating
 * @property string|null $comment
 * @property int $user_id
 * @property int $movie_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Movie $movie
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $posts
 * @property-read int|null $posts_count
 * @property-read \App\Models\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Thread newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Thread newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Thread onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Thread query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Thread whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Thread whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Thread whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Thread whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Thread whereMovieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Thread whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Thread whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Thread whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Thread withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Thread withoutTrashed()
 */
	class Thread extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WatchLater
 *
 * @property int $movie_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Movie $movie
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WatchLater newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WatchLater newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WatchLater query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WatchLater whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WatchLater whereMovieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WatchLater whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WatchLater whereUserId($value)
 */
	class WatchLater extends \Eloquent {}
}

