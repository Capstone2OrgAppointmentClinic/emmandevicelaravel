<style>
        body {
            background-color: #F8F9FA;
        }
        .container-wrapper {
            margin-top: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
        }

        .card {
            width: 60%;
            max-width: 800px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #AD1457;
            color: #fff;
            font-size: 28px;
            font-weight: bold;
            padding: 20px;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            text-align: center;
        }

        label {
            font-weight: bold;
            color: #333;
            font-size: 18px;
        }
        .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            font-size: 18px;
            padding: 12px;
            background-color: #fff;
            width: 100%;
        }

        textarea.form-control {
            background-color: #fff;
            resize: none;
            width: 100%;
            height: 150px;
        }
        .form-control:focus {
            background-color: #fff;
            box-shadow: none;
            border: 1px solid #AD1457;
        }
        .custom-file-input {
            padding: 12px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            width: 100%;
            font-size: 18px;
        }
        .btn-submit {
            background-color: #4CAF50;
            color: white;
            padding: 14px 24px;
            border-radius: 8px;
            width: 100%;
            font-size: 20px;
            transition: background-color 0.3s;
        }

        .btn-submit:hover {
            background-color: #45a049;
        }

        .alert-success {
            margin-top: 15px;
        }
textarea.form-control {
    background-color: #fff;
    color: #333;
    resize: none;
    width: 100%;
    height: 150px;
}
textarea::placeholder,
input::placeholder {
    color: #888 !important; 
    font-size: 16px;
}

.form-control:focus {
    background-color: #fff;
    color: #333;
    box-shadow: none;
    border: 1px solid #AD1457;
}

input[type="text"],
input[type="file"],
textarea.form-control {
    color: #333 !important; 
}
.custom-file-input::file-selector-button {
    background-color: #AD1457;
    color: #fff;
    padding: 8px 16px;
    border: none;
    border-radius: 8px;
    margin-right: 10px;
    cursor: pointer;
}
.custom-file-input {
    padding: 12px;
    border: 1px solid #ced4da;
    border-radius: 8px;
    font-size: 18px;
    background-color: #fff;
    color: #333;
}
.custom-file-input::file-selector-button:hover {
    background-color: #932952;
}
input[type="text"]:focus,
textarea:focus,
input[type="file"]:focus {
    background-color: #fff;
    color: #333;
    box-shadow: none;
    border: 1px solid #AD1457;
}

    </style>