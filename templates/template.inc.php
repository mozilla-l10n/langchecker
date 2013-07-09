<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title>.lang files checker on mozilla sites</title>
  <style type="text/css">

    body {
        color:black;
        background-color:white;
        font-family:arial;
        font-size:14px;
        padding-top:50px;
    }

    a {
        text-decoration:none;
    }

    a:hover {
    }

    table {
        border-collapse:collapse;
    }

    td, th {
        border:1px solid lightblue;
        padding:2px 2px;
        text-align:center;
    }


    th.filename {
        font-size:130%;
        background-color:lightblue;
    }

    table.globallist {
        float:left;
        margin-left:10px;

    }

    div.filename table.side {
        position:absolute;
        top:10px;
        right:10px;
    }

    div.filename table.python th,
    div.filename table.python td {
        text-align:left;
    }

    div.filename table.python td em {
        color:white;
        background-color: green;
        font-style:normal;
        border-radius: 3px;
        padding: 0 10px;
    }

    div.website {
        border:1px solid rgba(200, 200, 200, 1);
        margin:0 0 10px 0;
        padding:0 10px;
        background-color:rgba(230, 230, 255, 1);
    }

    div.filename,
    div.filedone {
        border:1px solid rgba(200, 200, 200, 1);
        margin-bottom:10px;
        padding:20px;
        background-color:white;
        border-radius:10px;
        position:relative;
    }

    div.filename {
        min-height:8em;
    }

    div.filedone {
        min-height:1em;
    }

    div.filedone p {
        float: left;
        font-size:130%;
        margin: 0 0 10px;
        padding: 2px 1em;
    }

    div.filedone h3.filedone,
    div.filename h3.filename {
        float:left;
        margin:0 0 10px 0;
        padding:2px 1em;
        text-align:center;
        min-width:11em;
        background-color: black;
        color:white;
        font-size:130%;
    }

    div.filename h3.filename a:link,
    div.filename h3.filename a:visited,
    div.filename h3.filename a:hover,
    div.filename h3.filename a:active
    {
        color:white;
    }



    div.filename p,
    div.filename h3 {
        clear:both;
    }

    div.filename div.tip {
        border:1px solid lightgray;
        padding:10px 0 10px 30px;
        background-color:lightyellow;
    }


    code {
        color:gray;
        font-family: monospace;
    }

    div.filename div.tip blockquote {
        color:blue;
        color:rgba(80,80,80,1)
    }



h1 {
    margin-bottom: 40px;
    margin-top: -50px;
    font-size:40px;
}

h1 span {
    display:inline-block;;
    background-color: #E6E6FF;
    border: 1px solid #C8C8C8;
    font-size:40px;
    padding:3px 10px;
    border-radius:5px;
}


    h2 {
        margin-top:5px;
    }

#back {
    background-color: rgba(0, 0, 0, 0.698);
    border-radius: 0 0 30px 30px;
    box-shadow: 1px 1px 6px darkgray;
    font-size: 15px;
    height: 50px;
    line-height: 50px;
    margin: 0;
    padding: 0 20px;
    position: absolute;
    right: 10px;
    text-align: center;
    text-shadow: 1px 1px 4px black;
    top: 0;
}

    #back a {
        color:white;
        font-family: Trebuchet;
        font-weight: bold;
        display: block;
        width:100%;
        height:100%;
    }

.dim {
    color: lightgray;
}

table.globallist th, table.globallist td {
    border:1px solid darkgray;
}

table.globallist th.filename {
    background: lightblue;
    color:black;
}

table.globallist th {
    background: lightblue;
    padding: 4px;
}

table.globallist {
    background: rgb(250,250,250);
}

  </style>

</head>

<body>
<?php include $view; ?>

</body>
</html>
