<template>
    <div>        
        <h3 class="text-center">Crear Materia</h3>
                <form @submit.prevent="addMateria">
                        <table class="table">
                            <tr>
                                <td>
                                    <input type="text" class="form-control" placeholder="Materia" v-model="materiaForm.nombre" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control" placeholder="Docentes" v-model="materiaForm.docente" required>
                                </td>
                                <td>
                                    <select class="form-control" v-model="materiaForm.tipo" title='Seleccione uno'>
                                        <option value="Cualitativa" selected="selected">Cualitativa</option>
                                        <option value="Cuantitativa">Cuantitativa</option>
                                    </select>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-primary">Agregar</button>
                                </td>
                            </tr>
                        </table>
                </form>

        <h2 class="text-center">Materias</h2>
         <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Docente</th>
                <th>Tipo</th>
               <th>Opt</th> 
            </tr>
            </thead>
            <tbody>
            <tr v-for="materia in materias" :key="materia.id">
                <td>{{ materia.id }}</td>
                <td>{{ materia.nombre }}</td>
                <td>{{ materia.docente }}</td>
                <td>{{ materia.tipo }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <button class="btn btn-danger" @click="deleteMaterias(materia.id)">Borrar</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                materiaForm: {},

                materias: []
            }
        },
        created() {
            this.axios
                .get('http://prueba-conocimiento.herokuapp.com/api/materias/')
                .then(response => {
                    this.materias = response.data;
                });
        },
        methods: {
            fecthData() {
            this.axios
                .get('http://prueba-conocimiento.herokuapp.com/api/materias/')
                .then(response => {
                    this.materias = response.data;
                });

            },
            deleteMaterias(id) { 
                this.axios
                    .delete(`http://prueba-conocimiento.herokuapp.com/api/materias/${id}`)
                    .then(response => {
                        let i = this.materias.map(data => data.id).indexOf(id);
                        this.materias.splice(i, 1)
                    });
            },
            addMateria() {
                this.axios
                    .post('http://prueba-conocimiento.herokuapp.com/api/materias/',{
							nombre: this.materiaForm.nombre,
							docente: this.materiaForm.docente,
							tipo: this.materiaForm.tipo
                   })
                    .then(response => (
                        this.materiaForm = {},
						this.fecthData()
                    ))
                    .catch(err => console.log(err))
                    .finally(() => this.loading = false)
            }   
           
        
        }
    }
</script>