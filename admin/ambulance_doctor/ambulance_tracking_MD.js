const express = require('express');
const { request } = require('http');

const app = express();
app.listen(3000, () => console.log('listening at 3000'));
app.use(express.static('public'));

app.post("/api", (request, response) => {
    console.log('I got a request!');
    console.log(request);
});
