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
 * @method static \Illuminate\Database\Eloquent\Builder|ExternalId newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExternalId newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExternalId query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExternalId whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExternalId whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExternalId whereMovieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExternalId whereName($value)
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
 * @property string|null $original_description
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
 * @property-read mixed $rating_count
 * @property-read mixed $watch_later
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Thread[] $threads
 * @property-read int|null $threads_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WatchLater[] $watchLaters
 * @property-read int|null $watch_laters_count
 * @method static \Illuminate\Database\Eloquent\Builder|Movie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Movie newQuery()
 * @method static \Illuminate\Database\Query\Builder|Movie onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Movie query()
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereBackdropPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereGenre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereOriginalDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereOriginalTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie wherePosterPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereYear($value)
 * @method static \Illuminate\Database\Query\Builder|Movie withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Movie withoutTrashed()
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
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Query\Builder|Post onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereThreadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Post withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Post withoutTrashed()
 */
	class Post extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder|Thread newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Thread newQuery()
 * @method static \Illuminate\Database\Query\Builder|Thread onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Thread query()
 * @method static \Illuminate\Database\Eloquent\Builder|Thread whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thread whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thread whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thread whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thread whereMovieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thread whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thread whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thread whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Thread withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Thread withoutTrashed()
 */
	class Thread extends \Eloquent {}
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
 * @property string|null $gender
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
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\Authenticatable, \Illuminate\Contracts\Auth\Access\Authorizable, \Tymon\JWTAuth\Contracts\JWTSubject {}
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
 * @method static \Illuminate\Database\Eloquent\Builder|WatchLater newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WatchLater newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WatchLater query()
 * @method static \Illuminate\Database\Eloquent\Builder|WatchLater whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WatchLater whereMovieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WatchLater whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WatchLater whereUserId($value)
 */
	class WatchLater extends \Eloquent {}
}

