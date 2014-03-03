<!DOCTYPE html>
<html lang="en">
    <head>
        <title>User Management Panel</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="User Management Panel">
        <meta name="author" content="Soslan Aldatov (http://supporteam.ru)">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {SCRIPTS}
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">User Panel</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    {MENU}
                </ul>
            </div>
        </div>
        <div class="container">
            <br>
            <div class="well alerts" style="display:none;">
                
            </div>
            <div class="page-header">
                <div class="input-group">
                    <span class="input-group-addon">{INPUT_FIELD}</span>
                    <input type="text" class="form-control {INPUT_CLASS}">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button" onclick="{INPUT_FUNCTION}">{INPUT_ACTION}</button>
                    </span>
                </div>
            </div>
            {BUTTONS}
            <div class="well {FIRST_CONTAINER}" style="display:none;">
                {FIRST_CONTAINER_CONTENT}
            </div>
            <div class="well {SECOND_CONTAINER}" style="display:none;">
                {SECOND_CONTAINER_CONTENT}
            </div>
            <div class="well {THIRD_CONTAINER}" style="display:none;">
                {THIRD_CONTAINER_CONTENT}
            </div>
            <div class="well {FOURTH_CONTAINER}">
                {FOURTH_CONTAINER_CONTENT}
            </div>
       	</div>
        </div>
    </body>
</html>