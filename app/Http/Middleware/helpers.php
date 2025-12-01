<?php
function roles($number)
{
    return session('user.Codigo_Rol') === $number;
}


