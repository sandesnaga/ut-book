<div id="body-part">
    <p style = "font-family: Verdana, Geneva, Tahoma, sans-serif; font-weight: bold; font-size: 28px; color: blue; position:relative; top:35px;left:155px; line-height:36px;">
            Connect with friends and the.<br>
            world around you on UTBOOK.
    </p>
    <div id= "image">
        <img src ="images\utbook.jpg" height="300px" width= "600px">
    </div>
    <div id ="signup_content_right">
        <p style="font-size: 36px; color: black; font-weight: bold;"> Create your UTBOOK account </p>
        <p style= "font-size:18px; color:black;"> <strong> Its free and always will be free </strong> </p>
    
    <div id= "form_signup" style="float:right">
        <form id= "signup" method="POST">
            <table>
                <tr>
                    <td>
                        <input type ="text" name="username" required="required" placeholder="FirstName">
                        <input type ="text" name="lastname" required="required" placeholder="LastName">

                    </td>
                </tr>
                <tr>
                        <td>
                            <input type ="email" name="useremail" required="required" placeholder="Email">    
                        </td>
                </tr>
                <tr>
                        <td>
                            <input type ="password" name="userpassword" required="required" placeholder="New Password">
                        </td>
                </tr>
                <tr>
                        <td>
                            <input type ="phone" name="phonenumber" required="required" placeholder="Phone Number">
                        </td>
                </tr>
                <tr>
                        <td>
                            <input type ="text" name="street" required="required" placeholder="Street">
                            <input type ="text" name="city" required="required" placeholder="City">
                        </td>
                </tr>
                <tr>
                        <td>
                                <input type ="text" name="state" required="required" placeholder="State">
                                <input type ="text" name="country" required="required" placeholder="Country">
                                 <input type ="text" name="zip" required="required" placeholder="Zip Code">
        
                        </td>
                </tr>
                <tr>
                        <td>
                            Birthday
                        </td>
                </tr>
                <tr>
                    <td>
                        <input type="date" name="user_birthday" required="required">
                    </td>
                </tr>

                <tr>
                        <td>
                            Gender
                        </td>
                </tr>
                    <td>
                        <select type="text" name="user_gender" required="required">
                            <option> Please Select your gender </option>
                            <option> Male </option>
                            <option> Female </option>
                            <option> Other </option>

                        </select>
                    </td>

                <tr>

            </table>
            <input style= "width:200px;height: 45px; font-weight:bold; background: green; border-radius: 5px; border: 0.5px solid white" type="submit"  name="sign_up" value="Create Account">
            <div>
                <?php include ("insert_user.php"); ?>
            </div>
         <form>
    </div>
</div>
</div>
</div>
</body>
</html>



