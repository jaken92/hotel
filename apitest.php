<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <section id="featureList"></section>
    <script>
        let list = document.createElement('ul')
        fetch('http://localhost:3000/backend.php')
            .then((response) => response.json())
            .then((features) => {
                features.forEach(feature => {
                    let li = document.createElement('li')
                    li.innerHTML = feature.name + " (" + feature.cost + ")"
                    list.appendChild(li);
                });
            })
        document.getElementById('featureList').appendChild(list)
    </script>
</body>
</html>