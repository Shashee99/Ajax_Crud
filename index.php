<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crud</title>
</head>
<body>

<form method="POST" onsubmit="return doInsert(this);">
    <input name="first_name" placeholder="First name">
    <input name="last_name" placeholder="Last name">

    <input type="submit" value="Insert">
</form>


<form method="POST" onsubmit="return doDelete(this);">
    <input name="employee_id" placeholder="Employee ID">
    <input type="submit" value="Delete">
</form>
<br>
<h1>Update</h1>
<form method="POST" onsubmit="return getUpdateData(this);">
    <input name="employee_id" placeholder="Employee ID">
    <input type="submit" value="Search">
</form>

<br>
<form method="POST" onsubmit="return doUpdate(this);" id="form-update" style="display: block;">
    <input type="hidden" name="employee_id">
    <input name="first_name" placeholder="First name">
    <input name="last_name" placeholder="Last name">
    <input type="submit" value="Update">
</form>
<table>
    <thead>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
    </tr>
    </thead>

    <tbody id="data"></tbody>
</table>


<script>
    function doInsert(form) {
        var firstName = form.first_name.value;
        var lastName = form.last_name.value;

        console.log("form");
        var ajax = new XMLHttpRequest();
        ajax.open("POST", "Http.php", true);
        ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        ajax.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200)
                alert(this.responseText);
        };


        ajax.send("first_name=" + firstName + "&last_name=" + lastName + "&do_insert=1");
        getData();
        return false;
    }

    function getData() {
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "Http.php?view_all=1", true);
        ajax.send();

        ajax.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                var html = "";

                for (var a = 0; a < data.length; a++) {
                    html += "<tr>";
                    html += "<td>" + data[a].firstName + "</td>";
                    html += "<td>" + data[a].lastName + "</td>";
                    html += "</tr>";
                }

                document.getElementById("data").innerHTML = html;
            }
        };
    }

    getData();

    function doDelete(form) {
        var emp_id = form.employee_id.value;
        console.log(form);
        var ajax = new XMLHttpRequest();
        ajax.open("POST", "Http.php", true);
        ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        ajax.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200)
                alert(this.responseText);
        };

        ajax.send("employee_id=" + emp_id + "&do_delete=1");

        getData();
        return false;
    }


    function getUpdateData(form) {

        var updateId = form.employee_id.value;

        var ajax = new XMLHttpRequest();
        ajax.open("POST", "Http.php", true);
        ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        ajax.onreadystatechange=function ()
        {
            if (this.readyState == 4 && this.status == 200) {

                var data = JSON.parse(this.responseText);
                var form = document.getElementById("form-update");

                console.log(this.responseText);
                console.log(data);

                /* Show data in 2nd form */
                form.first_name.value = data.firstName;
                form.last_name.value = data.lastName;
                form.employee_id.value = data.employeeNumber;

                form.style.display = "";


            }
        };
        ajax.send("update_Id=" + updateId + "&doupdate=1");
        return false;


    }

    function doUpdate(form){
        var firstName = form.first_name.value;
        var lastName = form.last_name.value;
        var employeeID = form.employee_id.value;

        var ajax = new   XMLHttpRequest();

        ajax.open("POST","Http.php",true);
        ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        ajax.send("first_name=" + firstName + "&last_name=" + lastName + "&employee_id=" + employeeID + "&do_update=1");

        ajax.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200)
                alert(this.responseText);
        };

        return false;
    }


</script>
</body>
</html>