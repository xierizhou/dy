var express = require('express');
var app = express();
var bodyParser = require('body-parser');
var dy= require('douyin_fuck.js');
var request = require('request');
 
// 创建 application/x-www-form-urlencoded 编码解析
var urlencodedParser = bodyParser.urlencoded({ extended: false })
 
app.use(express.static('public'));
 
app.get('/index.htm', function (req, res) {
   res.sendFile( __dirname + "/" + "index.htm" );
})
 
app.post('/process_post', urlencodedParser, function (req, res) {
 
   // 输出 JSON 格式
   var response = {
       "first_name":req.body.first_name,
       "last_name":req.body.last_name
   };


   /*console.log(tac);*/
   //console.log(req.body.tac);

    var signature = generateSignature(req.body.user_id,req.body.ua);
	res.json({user_id: req.body.user_id,signature:signature});

	/*var url="http://dy.dianca.com/getSignature";
	var requestData={
		user_id:57720812347,
		signature:signature
	};
	 res.json({users: 13});*/
    /*request({
        url: url,
        method: "POST",
        json: true,
        headers: {
            "content-type": "application/json",
        },
        body: requestData
    }, function(error, response, body) {
    	console.log(response.statusCode);
        if (!error && response.statusCode == 200) {
            console.log(body) 
        }
    });*/

   res.end(JSON.stringify(response));
})
 
var server = app.listen(8081, function () {
 
  var host = server.address().address
  var port = server.address().port
 
  console.log("应用实例，访问地址为 http://%s:%s", host, port)
 
})





 
