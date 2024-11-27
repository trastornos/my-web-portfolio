const express = require('express');
const mongoose = require('mongoose');
const path = require('path');
const app = express();
const cors = require('cors');
const Task = require('./models/Task');  // Modelo de tarea

// Middleware
app.use(express.json());
app.use(cors());
app.use(express.static(path.join(__dirname, 'public'))); // Servir archivos estáticos

// Conectar a MongoDB
mongoose.connect('mongodb://localhost:27017/tarea-app')
    .then(() => console.log('Conectado a MongoDB'))
    .catch(err => console.log('Error al conectar a MongoDB', err));

// Rutas de la API
app.get('/api/tasks', async (req, res) => {
    const tasks = await Task.find();
    res.json(tasks);
});

app.post('/api/tasks', async (req, res) => {
    const newTask = new Task(req.body);
    await newTask.save();
    res.status(201).json(newTask);
});

app.delete('/api/tasks/:id', async (req, res) => {
    const { id } = req.params;
    await Task.findByIdAndDelete(id);
    res.status(200).json({ message: 'Task deleted' });
});

// Puerto
const PORT = process.env.PORT || 5000;
app.listen(PORT, () => {
    console.log(`Servidor corriendo en el puerto ${PORT}`);
});
