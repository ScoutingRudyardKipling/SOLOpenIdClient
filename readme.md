## Scouting Nederland OpenId Client

### Installatie

Deze package is met composer toe te voegen middels het volgende commando:

```bash
composer require scoutingrudyardkipling/solopenidclient
```

### Voorbeeld (Laravel 5.x)

```php
public function login(Illuminate\Http\Request $request)
{
    $openid = new \ScoutingRudyardKipling\SOLOpenIdClient('http://your-return-url.nl');

    if (!$openid->mode && $request->has('username')) {
        $username = $request->input('username');

        return \Redirect::to($openid->setUserIdentity($username)->authUrl());
    } elseif (!!$openid->mode) {
        if ($openid->mode == 'cancel') {
            // user cancelled logging in
        } elseif ($openid->validate()) {
            // user login confirmed by Scouting Nederland, let's proceed!

            $user = $openid->getValidatedUser();

            // Either create a new user or link the returned SNL-user to one of your registered users.
            // Notice that SNL only confirmed that the user is who it claims to be and that he/she is an active
            // member of Scouting Nederland. You have to deal with authorisation yourself for instance to make sure
            // the authenticated user is a member of your scouting club.

        } else {
            // login failed
        }
    } else {
        // show a form where the user can provide his/her SNL username
    }
}
```