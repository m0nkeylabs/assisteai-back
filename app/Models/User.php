<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'access_token',
        'created_at',
        'updated_at',
        'deleted_at',
        'provider',
        'provider_id'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'provider',
        'provider_id',
        'access_token',
        'name',
        'username',
        'email',
        'avatar',
        'last_login_at',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Mapping the facebook fields to database columns
     *
     * @var array
     */
    protected static $graph_node_field_aliases = [
        'id' => 'provider_id',
        'picture.is_silhouette' => null,
        'picture.url' => 'avatar',
    ];

    public function posts()
    {
        $this->hasMany(Post::class);
    }

    public function threads()
    {
        $this->hasMany(Thread::class);
    }

    /**
     * {@inheritdoc}
     */
    public static function createOrUpdateGraphNode($data)
    {
        if ($data instanceof GraphObject || $data instanceof GraphNode) {
            $data = array_dot($data->asArray());
        }
        $fields = ['id', 'name', 'email', 'picture.url'];
        $wanted_data = [];
        foreach ($fields as $field) {
            $wanted_data[$field] = $data[$field];
        }

        $wanted_data['provider'] = 'Facebook';
        $wanted_data['access_token'] = \Session::get('fb_user_access_token');
        $wanted_data['last_login_at'] = date('Y-m-d H:i:s');

        $wanted_data = static::convertGraphNodeDateTimesToStrings($wanted_data);

        if (!isset($wanted_data['id'])) {
            throw new \InvalidArgumentException('Graph node id is missing');
        }

        $attributes = [static::getGraphNodeKeyName() => $wanted_data['id']];

        $graph_node = static::firstOrNewGraphNode($attributes);

        static::mapGraphNodeFieldNamesToDatabaseColumnNames($graph_node, $wanted_data);

        $graph_node->save();

        return $graph_node;
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
