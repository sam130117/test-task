<!DOCTYPE html>
<html lang="en">
<head>
    <title>Caesar Cipher</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">


    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>

    <script src="js/script.js"></script>
</head>
<body>
    <div class="container">
        <div class="panel-group">
            <div class="panel panel-default ">
                <div class="panel-heading dark-blue-background">
                    <h2 class="panel-title main-heading">Caesar cipher
                        <a class="pull-right" data-toggle="collapse" href="#description">
                            <span class="bounce-toggle glyphicon glyphicon-info-sign"></span>
                        </a>
                    </h2>
                </div>
                <div id="description" class="panel-collapse collapse">
                    <div class="panel-body sub-heading">
                        <p>A Caesar cipher is one of the simplest and most widely known
                            encryption techniques. It is a type of substitution cipher in which each letter in the plaintext is replaced
                            by a letter some fixed number of positions down the alphabet. For example, with a left shift of 3, D
                            would be replaced by A, E would become B, and so on. The method is named after Julius Caesar, who used it
                            in his private correspondence.</p>
                    </div>
                </div>
            </div>
        </div>
        <hr/>

        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="sourceText">Initial text</label>
                        <textarea class="form-control" id="sourceText" rows="10" placeholder="Please enter text"></textarea>
                    </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                <div class="form-group-container">

                    <div class="form-group group-height">
                        <label for="offsetNumber">Offset </label>
                        <input class="form-control" id="offsetNumber" type="number" />
                        <h5 id="offsetError" class="error-message"></h5>

                        <hr/>
                    </div>

                    <div class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-6">
                        <button class="btn button-dark-blue" type="submit" id="encryptButton">Encrypt</button>
                    </div>

                    <div class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-6 ">
                        <button class="btn button-dark-blue" type="submit" id="decryptButton">Decrypt</button>
                    </div>

                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="sourceText">Result text</label>
                    <textarea class="form-control" id="processedText" rows="10" readonly></textarea>
                </div>
            </div>
        </div>

        <div id="diagramContainer">
            <div id="frequencyAnalysisResultMessage" class="alert text-info">
                <span> The estimated offset for this text is </span>
                <span id="estimatedOffset"></span>.
                <a id="decryptionAttempt">Try to decrypt</a>
            </div>

            <div id ='chart-container'></div>
        </div>
    </div>

</body>
</html>


