import Model from '@/Models/Model';

export default class User extends Model {
  id;
  first_name = '';
  last_name = '';
  email = '';
  permissions = ['create-games'];

  static defaults = {
    first_name: '',
    last_name: '',
    email: '',
    permissions: ['create-games'],
  };

  constructor(params) {
    super();

    this.id = params.id || null;
    this.first_name = params.first_name;
    this.last_name = params.last_name;
    this.email = params.email;
    // this.permissions = params.permissions || [];
  }

  static make(params = User.defaults) {
    return new User(params);
  }

  can(permissionName) {
    return this.permissions.some(permission => permission === permissionName);
  }
}
