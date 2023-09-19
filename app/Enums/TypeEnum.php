<?php
  
namespace App\Enums;

enum TypeEnum:string {
    case Graphick = 'графическое издание';
    case Digital = 'цифровое издание';
    case Print = 'печатное издание';
}