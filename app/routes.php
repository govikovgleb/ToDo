<?php
return [
    ['/', 'TaskControler', 'action'],
    ['/logout', 'AuthControler', 'logout'],
    ['/logout', 'TaskControler', 'action'],
    ['/login', 'AuthControler', 'login'],
    ['/login', 'TaskControler', 'action'],
    ['/update_task', 'TaskControler', 'taskUpdate'],
    ['/add_task', 'TaskControler', 'taskAdd'],
];