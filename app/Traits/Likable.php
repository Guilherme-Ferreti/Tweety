<?php

namespace App\Traits;

use App\Models\Like;

trait Likable
{
    public function scopeWithLikes($query)
    {
        if (env('DB_CONNECTION') === 'sqlsrv') {

            $query->leftJoinSub(
                'select tweet_id, SUM(CASE WHEN liked = 1 THEN 1 ELSE 0 END) likes, SUM( CASE WHEN liked = 0 THEN 1 ELSE 0 END) dislikes from likes group by tweet_id',
                'likes',
                'likes.tweet_id',
                'tweets.id'
            );
        }

        if (env('DB_CONNECTION') === 'mysql') {
            
            $query->leftJoinSub(
                'select tweet_id, sum(liked) likes, sum(!liked) dislikes from likes group by tweet_id',
                'likes',
                'likes.tweet_id',
                'tweets.id'
            );
        }
    }

    public function like($user = null, $liked = true)
    {
        $this->likes()->updateOrCreate([
            'user_id' => $user ? $user->id : auth()->user()->id,
        ], [
            'liked' => $liked
        ]);
    }

    public function dislike($user = null)
    {
        return $this->like($user, false);
    }

    public function isLikedBy($user)
    {
        return (bool) $user->likes->where('tweet_id', $this->id)->where('liked', true)->count();
    }

    public function isDislikedBy($user)
    {
        return (bool) $user->likes->where('tweet_id', $this->id)->where('liked', false)->count();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
