from flask import Flask, request, session
from flask_sqlalchemy import SQLAlchemy
from flask_mail import Mail, Message
# from celary import make_celary
import json

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+pymysql://root:mysql@localhost/ums'
# app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+pymysql://root:@localhost/ums'
# app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+pymysql://root:password@localhost/ums'
app.config['SECRET_KEY'] = 'hard to gusess string'
app.config['UPLOAD_FOLDER'] = 'C:\\Users\\hello\\Desktop\\IMS\\static\\uploads'
# app.config['CELERY_BROKER_URL'] = 'amqp://localhost//'
app.config['MAIL_SERVER'] = 'smtp.gmail.com'
app.config['MAIL_PORT'] = 587
app.config['MAIL_USE_TLS'] = True
app.config['MAIL_USERNAME'] = 'chinmaymishra.falna@gmail.com'
app.config['MAIL_PASSWORD'] = 'empty'
db = SQLAlchemy(app)
mail = Mail(app)
# celery = make_celary(app)

from views import *

if __name__ == "__main__":
    # app.run(host='0.0.0.0', port='5000', debug=True)
    # db.drop_all()
    # db.create_all()
    app.run(debug=True)