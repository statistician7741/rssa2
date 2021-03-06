<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Phphub\Registration\Events\UserHasRegistered;
use Laracasts\Commander\Events\EventGenerator;
use Laracasts\Presenter\PresentableTrait;
use Phphub\Users\FollowableTrait;
use Zizaco\Entrust\HasRole;
use Cmgmyr\Messenger\Traits\Messagable;

class User extends \Eloquent implements UserInterface, RemindableInterface
{
    // Using: $user->present()->anyMethodYourWant()
    use PresentableTrait, RemindableTrait, EventGenerator, FollowableTrait, Messagable;
    public $presenter = 'Phphub\Presenters\UserPresenter';

    // Enable hasRole( $name ), can( $permission ),
    //   and ability($roles, $permissions, $options)
    use HasRole;

    // Enable soft delete
    use SoftDeletingTrait;
    protected $dates = ['deleted_at'];

    protected $table      = 'users';
    protected $hidden     = ['github_id'];

    /**
     * Passwords must always be hashed.
     *
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
    protected $guarded    = ['id', 'notifications', 'is_banned'];

    public static function boot()
    {
        parent::boot();

        static::created(function ($topic) {
            SiteStatus::newUser();
        });
    }

    public static function register($name, $email, $password, $cat_one, $cat_two, $cat_three, $sex)
    {
        $user = new static(compact('name', 'email', 'password', 'cat_one', 'cat_two', 'cat_three', 'sex'));
        $user->raise(new UserHasRegistered($user));
        return $user;
    }

    /**
     * Determine if the given user is the same
     * as the current one.
     *
     * @param  $user
     * @return bool
     */
    public function is($user)
    {
        if (is_null($user)) return false;

        return $this->name == $user->name;
    }

    public function favoriteTopics()
    {
        return $this->belongsToMany('Topic', 'favorites')->withTimestamps();
    }

    public function attentTopics()
    {
        return $this->belongsToMany('Topic', 'attentions')->withTimestamps();
    }

    public function topics()
    {
        return $this->hasMany('Topic');
    }

    public function replies()
    {
        return $this->hasMany('Reply');
    }

    public function notifications()
    {
        return $this->hasMany('Notification')->recent()->with('topic', 'fromUser')->paginate(20);
    }

    public function getByGithubId($id)
    {
        return $this->where('github_id', '=', $id)->first();
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * ----------------------------------------
     * UserInterface
     * ----------------------------------------
     */

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * ----------------------------------------
     * RemindableInterface
     * ----------------------------------------
     */

    public function getReminderEmail()
    {
        return $this->email;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * Cache github avatar to local
     * @author Xuan
     */
    public function cacheAvatar()
    {
        //Download Image
        $guzzle = new GuzzleHttp\Client();
        $response = $guzzle->get($this->image_url);

        //Get ext
        $content_type = explode('/', $response->getHeader('Content-Type'));
        $ext = array_pop($content_type);

        $avatar_name = $this->id . '_' . time() . '.' . $ext;
        $save_path = public_path('uploads/avatars/') . $avatar_name;

        //Save File
        $content = $response->getBody()->getContents();
        file_put_contents($save_path, $content);

        //Delete old file
        if ($this->avatar) {
            @unlink(public_path('uploads/avatars/') . $this->avatar);
        }

        //Save to database
        $this->avatar = $avatar_name;
        $this->save();
    }
}
