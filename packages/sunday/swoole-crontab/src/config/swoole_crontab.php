<?php
return [
    'ip'=>'0.0.0.0',
    'port'=>'9818',
    'task'=>[
        /**
         *  timing
         *
         *      0     1    2    3    4    5
         *      *     *    *    *    *    *
         *      -     -    -    -    -    -
         *      |     |    |    |    |    |
         *      |     |    |    |    |    +----- day of week (0 - 6) (Sunday=0)
         *      |     |    |    |    +----- month (1 - 12)
         *      |     |    |    +------- day of month (1 - 31)
         *      |     |    +--------- hour (0 - 23)
         *      |     +----------- min (0 - 59)
         *      +------------- sec (0-59)
         */
        [
            'name'=>'test',
            'timing'=>'* */2 * * * *',
            'command'=>'sleep 2',

        ],

        [
            'name'=>'bbb',
            'timing'=>'* */2 * * * *',
            'command'=>'sleep 3',

        ],

        [
            'name'=>'ccc',
            'timing'=>'* */2 * * * *',
            'command'=>'php -v',
        ],


        [
            'name'=>'ddd',
            'timing'=>'* */2 * * * *',
            'command'=>'php -v',

        ]
    ],
];