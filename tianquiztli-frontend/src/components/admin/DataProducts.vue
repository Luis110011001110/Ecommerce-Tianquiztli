<template>
  <v-row
    justify="center"
    col=12>
    <v-col
      v-if="showTable==false">
      <v-card 
        ref="form">
        <v-card-text>
          <v-row
            justify="center"
            col=12>
          <v-img
            v-if="edit == true"
            v-model="img3"
            :src= "this.images[0].img_name"
            max-width="150px">
          </v-img>
          </v-row>
          <v-file-input
            accept="image/png, image/jpeg, image/bmp"
            placeholder="Seleccionar imagen"
            prepend-icon="mdi-camera"
            label="Imagen"
            required
            @change="readFile($event)">
          </v-file-input>
          <v-text-field
            ref="Nombre"
            v-model="product_name"
            :rules="[() => !! product_name || 'El campo es requerido' && rules]"
            counter
            maxlength="30"
            :error-messages="errorMessages"
            label="Nombre"
            required>
          </v-text-field>
          <v-autocomplete
            ref=""
            v-model="selection_category"
            :rules="[() => !! selection_category || 'This field is required']"
            :items="categories"
            item-text= "category"
            item-value= "id"
            label="Categorías"
            required>
          </v-autocomplete>
          <v-text-field
            ref=""
            v-model="dimentions"
            :rules="[() => !!dimentions || 'El campo es requerido' && rules]"
            label="Dimensiones"
            counter
            maxlength="100"
            required
          ></v-text-field>
          <v-text-field
            ref=""
            v-model="product_weight"
            :rules="[() => !!product_weight || 'El campo es requerido']"
            label="Peso"
            suffix="gr"
            @keypress="onlyNumber" type="text"
            required>
          </v-text-field>
          <v-text-field
            ref=""
            v-model="price"
            :rules="[() => !!price || 'El campo es requerido']"
            prefix="$"
            label="Precio"
            @keypress="onlyNumber" type="text"
            required>
          </v-text-field>
          <v-text-field
            ref=""
            v-model="stock"
            :rules="[() => !!stock || 'El campo es requerido']"
            label="Cantidad en tu inventario"
            @keypress="onlyNumber" type="text"
            required>
          </v-text-field>
          <v-text-field
            ref=""
            v-model="size"
            :rules="[() => !!size || 'El campo es requerido' && rules]"
            label="Talla"
            counter
            maxlength="30"
            required>
          </v-text-field>
        </v-card-text>
        <v-divider 
          class="mt-2" >
        </v-divider>
          <v-card-actions>
            <v-btn
              color="error"
              class="mt-2 mb-2 ml-12 mr-2"
              dark
              large
              @click="hideForm()">
                Cancelar
            </v-btn>
            <v-spacer></v-spacer>
            <v-btn
              color="success"
              class="mt-2 mb-2 ml-2 mr-12"
              dark
              large
              v-if="showButton==false"
              @click="saveProduct()">
                Guardar
            </v-btn>
            <v-btn
              color="success"
              v-if="showButton==true"
              class="mt-2 mb-2 ml-2 mr-12"
              dark
              large
              @click="updateProduct()">
                Actualizar
            </v-btn>
          </v-card-actions>
      </v-card>
    </v-col>
    <v-container
      v-if="showTable==true">
      <v-row
        justify="center">
        <v-btn
          color="cyan"
          class="mt-5 mb-8"
          dark
          large
          @click="showForm" >
            Agregar Productos
        </v-btn>
      </v-row>
      <v-simple-table>
      <template >
        <thead>
          <tr>
            <th 
              class="text-center">
              Identificador
            </th>
            <th 
              class="text-center">
              Nombre
            </th>
            <th 
              class="text-center">
              Categoria
            </th>
            <th 
              class="text-center">
              Dimensiones
            </th>
            <th 
              class="text-center">
              Peso (gr)
            </th>
            <th 
              class="text-center">
              Precio
            </th>
            <th 
              class="text-center">
              Stock
            </th>
            <th 
              class="text-center">
              Talla
            </th>
            <th 
              class="text-center">
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(product,index) in products"
            :key="product.id">
            <td>{{ product.id}}</td>
            <td>{{ product.product_name }}</td>
            <td>{{ product.category }}</td>
            <td>{{ product.dimentions }}</td>
            <td>{{ product.product_weight }}</td>
            <td>{{ product.price }}</td>
            <td>{{ product.stock }}</td>
            <td>{{ product.size }}</td>
  
            <v-btn
              class="mx-1 mt-2 mr-2"
              fab
              x-small
              dark
              color="cyan" 
              @click="updateButtonProduct(index)">
              <v-icon dark>
                mdi-pencil
              </v-icon>
            </v-btn>
  
            <v-btn
              class="mx-1 mt-2 ml-2"
              fab
              x-small
              dark
              color="red"
              @click="getIdImg(index)">
              <v-icon dark>
                block
              </v-icon>
            </v-btn>
          </tr>
        </tbody>
      </template>
    </v-simple-table>
  </v-container>
   
  </v-row>
  
</template>

<script>
import axios from 'axios';
export default {
  data () {
    return {
      path:'http://127.0.0.1:8000/api/v1',
      products:'',
      edit: false,
      token: localStorage.token,
      product:'',
      id_artisan:localStorage.id_artisan,
      product_name:'',
      price:'',
      dimentions:'',
      id_categorie:'',
      product_weight:'',
      categories:'',
      selection_category:'',
      size:'',
      stock:'',
      showTable: true,
      showButton: false,
      id_product:'',
      image64:'',
      image:'',
      images:'',
      id_prouducto:'',
      rules: [v => v.length <= 30 || 'Máximo 30 caracteres'],
    }
  },
  methods:{
    showForm (type) {
      this.showTable = false;
      if (type == 1){
        this.showButton = false;
      }
    },
    hideForm () {
      this.showTable = true
      this.product_name='';
      this.price='';
      this.selection_category = '';
      this.dimentions='';
      this.product_weight='';
      this.size='';
      this.stock='';
      this.edit = false;
    },
    onlyNumber ($event) {
       let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
        if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) { // 46 is dot
          $event.preventDefault();
      }
    },
    readFile(event){
      const toBase64 = file => new Promise((resolve, reject) => {
	    const reader = new FileReader();
	    reader.readAsDataURL(file);
	    reader.onload = () => resolve(reader.result);
	    reader.onerror = error => reject(error);
	    });
      toBase64(event)
		    .then(res => {
			  this.image64 = res
		  })
		  .catch(err => {
			  console.log(err);
		  }) 
    },
    saveProduct() {
      let product = {
        "product_name": this.product_name,
        "price":this.price,
        "dimentions":this.dimentions,
        "product_weight":this.product_weight,
        "size":this.size,
        "stock":this.stock
      }
      axios.post(`${this.path}/products/store/${this.id_artisan}/${this.selection_category}?token=${this.token}`, product)
        .then(data => {
        let id_product1 = data.data.response.id;
        this.saveImagen(id_product1);
          this.getProducts()
          this.showTable = true
        })
        .catch(error => {
          this.$swal.fire({
            icon: 'error',
            title: 'Error',
            text: '¡Por favor inténtalo nuevamente!',
            confirmButtonColor: '#3F51B5',
            timer: 4000,
            timerProgressBar: true
          });
        }); 
    },
    saveImagen(id_product1){
      let imagen = {
          "img_name": this.image64    
      }
      axios.post(`${this.path}/images/store/${id_product1}?token=${this.token}`, imagen)
        .then(data => {
          this.$swal.fire({
            title: 'Guardado',
            text: 'Producto guardado',
            icon: 'success',
            confirmButtonColor: '#3F51B5',
            timer: 4000,
            timerProgressBar: true
          })
        })
        .catch(error => {
          this.$swal.fire({
            icon: 'error',
            title: 'Error',
            text: '¡Por favor inténtalo nuevamente!',
            confirmButtonColor: '#3F51B5',
            timer: 4000,
            timerProgressBar: true
          });
        });
      this.showTable = true
      this.hideForm()
    },
    updateImagen(){
      let imagen = {
          "img_name": this.image64
      }
      axios.put(`${this.path}/images/edit/${this.images[0].id}?token=${this.token}`, imagen)
        .then(data => {
          this.$swal.fire({
            title: 'Guardado',
            text: 'Producto actualizado',
            icon: 'success',
            confirmButtonColor: '#3F51B5',
            timer: 4000,
            timerProgressBar: true
          })
        })
        .catch(error => {
          this.$swal.fire({
            icon: 'error',
            title: 'Error',
            text: '¡Por favor inténtalo nuevamente!',
            confirmButtonColor: '#3F51B5',
            timer: 4000,
            timerProgressBar: true
          });
        });
      this.showTable = true
    },
    updateButtonProduct(index){
      this.showForm();
      this.edit = true;
      this.getCategori();
      this.showButton = true;
      this.product = this.products[index];
      this.image = this.images[index];
      this.product_name = this.product.product_name
      this.dimentions = this.product.dimentions
      this.price = this.product.price
      this.product_weight = this.product.product_weight
      this.size = this.product.size
      this.size = this.product.size
      this.stock = this.product.stock
      this.id_prouducto = this.product.id
      this.selection_category = this.product.id_categorie
      this.getImagen()
    },
    getProducts(){
      axios.get(`${this.path}/products/index/${this.id_artisan}/-1/`)
        .then(data => {
          this.products = data.data.products;
        })
        .catch(error => {
          this.$swal.fire({
            icon: 'error',
            title: 'Error',
            text: '¡No hay registros!',
            confirmButtonColor: '#3F51B5',
            timer: 4000,
            timerProgressBar: true
          });
        });
    },
    getCategori(){
      axios.get(`${this.path}/categories/index`)
        .then(data => {
          this.categories = data.data.categories;      
        })
        .catch(error => {
          this.$swal.fire({
            icon: 'error',
            title: 'Error',
            text: '¡No hay categorias!',
            confirmButtonColor: '#3F51B5',
            timer: 4000,
            timerProgressBar: true
          });
        });
    },
    deletProducts(id_product){
      axios.delete(`${this.path}/products/delete/${id_product}?token=${this.token}`)
        .then(data => {
          this.$swal.fire({
            title: 'Eliminado',
            text: 'Producto eliminado',
            icon: 'success',
            confirmButtonColor: '#3F51B5',
            timer: 4000,
            timerProgressBar: true
          })
          this.getProducts()
        })
        .catch(error => {
          this.$swal.fire({
            icon: 'error',
            title: 'Error',
            text: '¡No se puede eliminar producto!',
            confirmButtonColor: '#3F51B5',
            timer: 4000,
            timerProgressBar: true
          });
        });
    },
    getIdImg(index){
      this.product = this.products[index];
       let id_eliminarproducto = this.product.id
      axios.get(`${this.path}/images/index/${id_eliminarproducto}`)
        .then(data => {
           let id_img = data.data.images[0].id;
           this.deleteImg(id_img,id_eliminarproducto);
        })
        .catch(error => {
          this.$swal.fire({
            icon: 'error',
            title: 'Error',
            text: '¡No se puede eliminar producto!',
            confirmButtonColor: '#3F51B5',
            timer: 4000,
            timerProgressBar: true
          });
        });
    },
    deleteImg(id_img, id_product){
      axios.delete(`${this.path}/images/delete/${id_img}?token=${this.token}`)
        .then(data => {
           this.deletProducts(id_product)
        })
        .catch(error => {
          this.$swal.fire({
            icon: 'error',
            title: 'Error',
            text: '¡No se puede eliminar producto!',
            confirmButtonColor: '#3F51B5',
            timer: 4000,
            timerProgressBar: true
          });
        });
    },
    updateProduct(){
        
        let product = {
          "product_name": this.product_name,
          "price":this.price,
          "dimentions":this.dimentions,
          "product_weight":this.product_weight,
          "size":this.size,
          "stock":this.stock,
          "id_categorie":this.categories.selection_category
        }
        axios.put(`${this.path}/products/edit/${this.id_prouducto}?token=${this.token}`, product)
          .then(data => {
            if (this.image64 != null || this.image64 != undefined || this.image64 !=''){       
              this.updateImagen();
            }  
            this.hideForm()   
            this.getProducts()
            this.showTable = true;
          })
          .catch(error => {
            this.$swal.fire({
              icon: 'error',
              title: 'Error',
              text: '¡Por favor inténtalo nuevamente!',
              confirmButtonColor: '#3F51B5',
              timer: 4000,
              timerProgressBar: true
            });
          });
    },
    getImagen(){
      axios.get(`${this.path}/images/index/${this.id_prouducto}`)
        .then(data => {
          this.images = data.data.images;
        })
        .catch(error => {
          this.$swal.fire({
            icon: 'error',
            title: 'Error',
            text: '¡No hay imagenes!',
            confirmButtonColor: '#3F51B5',
            timer: 4000,
            timerProgressBar: true
          });
        });
    }
  },
  created(){
    this.getProducts();
    this.getCategori();
  }
}
</script>

<style>
.legend {
  background-color: #107622;
}

a {
  text-decoration: none;
  color: #42b983 !important;
}
</style>
