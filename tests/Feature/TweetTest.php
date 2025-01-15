<?php

use App\Models\Tweet;
use App\Models\User;

it('has tweet page', function () {
    // ユーザを作成
    $user = User::factory()->create();

    // ユーザを認証
    $this->actingAs($user);

    // Tweetを作成
    $tweet = Tweet::factory()->create();

    // GETリクエスト Tweetの一覧を取得
    $response = $this->get('/tweets');

    // 200ステータスコードが返ってくることを確認
    $response->assertStatus(200);
    // Tweetの内容が表示されていることを確認
    $response->assertSee($tweet->tweet);
    // Tweetのユーザ名が表示されていることを確認
    $response->assertSee($tweet->user->name);
});

it('displays the create tweet page', function(){
    $user = User::factory()->create();

    $this->actingAs($user);

    // GETリクエストでTweet作成ページを取得
    $response = $this->get('/tweets/create');

    $response->assertStatus(200);
});


it('allows authenticated users to create a tweet', function(){
    $user = User::factory()->create();

    $this->actingAs($user);

    $tweetData = ['tweet' => 'This is a test tweet.'];

    $response = $this->post('/tweets', $tweetData);

    $this->assertDatabaseHas('tweets', $tweetData);

    // 作成の処理はリダイレクトされる。その際のステータスコード302を確認
    $response->assertStatus(302);
    $response->assertRedirect('/tweets');
    
});

it('display a tweet', function(){
    $user = User::factory()->create();

    $this->actingAs($user);

    $tweet = Tweet::factory()->create();

    $response = $this->get("/tweets/{$tweet->id}");

    $response->assertStatus(200);
    $response->assertSee($tweet->tweet);
    $response->assertSee($tweet->created_at->format('Y-m-d H:i'));
    $response->assertSee($tweet->updated_at->format('Y-m-d H:i'));
    $response->assertSee($tweet->user->name);
});

it('displays the edit tweet page', function(){
    $user = User::factory()->create();
    $this->actingAs($user);

    $tweet = Tweet::factory()->create();
    $response = $this->get("/tweets/{$tweet->id}/edit");

    $response->assertStatus(200);
    $response->assertSee($tweet->tweet);
});
it('allows a user to update their tweet', function(){
    $user = User::factory()->create();
    $this->actingAs($user);

    $tweet = Tweet::factory()->create();

    $tweetData=['tweet' => 'This is an updated tweet.'];
    $response = $this->put("/tweets/{$tweet->id}", $tweetData);

    $this->assertDatabaseHas('tweets', $tweetData);

    $response->assertStatus(302);
    $response->assertRedirect("/tweets/{$tweet->id}");
});
it('allows a user to delete their tweet', function(){
    $user = User::factory()->create();
    $this->actingAs($user);

    $tweet = Tweet::factory()->create();
    $response = $this->delete("/tweets/{$tweet->id}");

    $response->assertStatus(302);
    $response->assertRedirect('/tweets');

});