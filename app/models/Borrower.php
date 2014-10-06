<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Borrower extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $table = 'borrowers';
	protected $fillable = ['borrower_code', 'first_name', 'last_name'];

	public static $daysExpired = 5;
	public static $perDayPenalty = 1;
}