<template>
  <v-form v-model="valid">
    <v-container>
      <v-layout>

        <v-flex xs12 md4>
          <v-text-field
            v-model="email"
            :rules="emailRules"
            label="E-mail"
            required
          ></v-text-field>
        </v-flex>

        <v-flex xs12 md4>
          <v-text-field
            v-model="pass"
            :rules="passRules"
            :counter="10"
            label="password"
            required
          ></v-text-field>
        </v-flex>

        <v-flex xs12 md4>
          <v-btn　flat>login</v-btn>
        </v-flex>

      </v-layout>
    </v-container>
  </v-form>
</template>

<script>
  export default {
    data: () => ({
      valid: false,
      id: '',
      pass: '',
      passRules: [
        v => !!v || 'id is required',
        v => v.length <= 10 || 'Name must be less than 10 characters'
      ],
      email: '',
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+/.test(v) || 'E-mail must be valid'
      ]
    })
  }
</script>

<style>

</style>
