<?php

use App\Livewire\Site\{StatusAccount, VerifyEmail};
use App\Livewire\Subscription\Home;
use Illuminate\Support\Facades\Route;

Route::get("/criar/site", Home::class)->name("site.subscription");
Route::get("/conta/criada", StatusAccount::class)->name("site.status.account");
Route::get("/verificar/email", VerifyEmail::class)->name("site.verify.email");