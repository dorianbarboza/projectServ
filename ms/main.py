#!/usr/bin/env python
# -*- coding: utf-8 -*-

import pymysql
from app import app
from db_config import mysql
from flask import jsonify
from flask import flash, request
from werkzeug import generate_password_hash, check_password_hash

@app.route('/add', methods=['POST'])
def add():
	try:
		_json = request.json
		_ID_Artista = _json['ID_Artista']
		_Seudonimo = _json['_Seudonimo']
		_Nombre = _json['Nombre']
		_Apellido = _json['Apellido']
		_FechaNacimiento = _json['FechaNacimiento']
		_Ciudad = _json['Ciudad']
		_Pais = _json['Pais']
		_UrlImg = _json['UrlImg']
		# validate the received values
		if _ID_Artista and _Seudonimo and _Nombre and _Apellido and _FechaNacimiento and _Ciudad and _Pais and _UrlImg and request.method == 'POST':
			#do not save password as a plain text
			#_hashed_password = generate_password_hash(_password)
			# save edits
			sql = "INSERT INTO Artista (ID_Artista, Seudonimo, Nombre, Apellido, FechaNacimiento, Ciudad, Pais, UrlImg) VALUES(%s, %s, %s, %s, %s, %s, %s, %s)"
			data = (_ID_Artista, _Seudonimo, _Nombre, _Apellido, _FechaNacimiento, _Ciudad, _Pais, _UrlImg ,)
			conn = mysql.connect()
			cursor = conn.cursor()
			cursor.execute(sql, data)
			conn.commit()
			resp = jsonify('User added successfully!')
			resp.status_code = 200
			return resp
		else:
			return not_found()
	except Exception as e:
		print(e)
	finally:
		cursor.close()
		conn.close()
## GET All Users
@app.route('/AllArtista')
def getAllArtista():
	try:
		conn = mysql.connect()
		cursor = conn.cursor(pymysql.cursors.DictCursor)
		cursor.execute("SELECT * FROM Artista")
		rows = cursor.fetchall()
		resp = jsonify(rows)
		resp.status_code = 200
		return resp
	except Exception as e:
		print(e)
	finally:
		cursor.close()
		conn.close()

@app.route('/user/<int:id_artista>')
def user(id_artista):
	try:
		conn = mysql.connect()
		cursor = conn.cursor(pymysql.cursors.DictCursor)
		cursor.execute("SELECT ID_Artista id_artista, Seudonimo seudonimo, Nombre nombre, Apellido apellido, FechaNacimiento fechanacimiento, Ciudad ciudad, Pais pais, UrlImg urlimg FROM Artista WHERE ID_Artista=%s", id_artista)
		row = cursor.fetchone()
		resp = jsonify(row)
		resp.status_code = 200
		return resp
	except Exception as e:
		print(e)
	finally:
		cursor.close()
		conn.close()

@app.route('/update', methods=['PUT'])
def update():
	try:
		_json = request.json
		_ID_Artista = _json['ID_Artista']
		_Seudonimo = _json['_Seudonimo']
		_Nombre = _json['Nombre']
		_Apellido = _json['Apellido']
		_FechaNacimiento = _json['FechaNacimiento']
		_Ciudad = _json['Ciudad']
		_Pais = _json['Pais']
		_UrlImg = _json['UrlImg']
		# validate the received values
		if _ID_Artista and _Seudonimo and _Nombre and _Apellido and _FechaNacimiento and _Ciudad and _Pais and _UrlImg and request.method == 'PUT':
			#do not save password as a plain text
			#_hashed_password = generate_password_hash(_password)
			# save edits
			sql = "UPDATE Artista SET Seudonimo=%s, Nombre=%s, Apellido=%s, FechaNacimiento=%s, Ciudad=%s, Pais=%s, UrlImg=%s WHERE ID_Artista=%s"
			data = (_ID_Artista, _Seudonimo, _Nombre, _Apellido, _FechaNacimiento, _Ciudad, _Pais, _UrlImg, ID_Artista,)
			conn = mysql.connect()
			cursor = conn.cursor()
			cursor.execute(sql, data)
			conn.commit()
			resp = jsonify('User updated successfully!')
			resp.status_code = 200
			return resp
		else:
			return not_found()
	except Exception as e:
		print(e)
	finally:
		cursor.close()
		conn.close()

@app.route('/delete/<int:id>', methods=['DELETE'])
def delete_user(id):
	try:
		conn = mysql.connect()
		cursor = conn.cursor()
		cursor.execute("DELETE FROM Artista WHERE ID_Artista=%s", (id,))
		conn.commit()
		resp = jsonify('User deleted successfully!')
		resp.status_code = 200
		return resp
	except Exception as e:
		print(e)
	finally:
		cursor.close()
		conn.close()

@app.errorhandler(404)
def not_found(error=None):
    message = {
        'status': 404,
        'message': 'Not Found: ' + request.url,
    }
    resp = jsonify(message)
    resp.status_code = 404

    return resp

if __name__ == "__main__":
    app.run(debug=True)
