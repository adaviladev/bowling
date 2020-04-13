import Model from '@/Models/Model';

export default class User extends Model {
  id;
  first_name = '';
  last_name = '';
  email = '';

  constructor(params) {
    super();

    this.id = params.id || null;
    this.first_name = params.first_name;
    this.last_name = params.last_name;
    this.email = params.email;
  }
}
