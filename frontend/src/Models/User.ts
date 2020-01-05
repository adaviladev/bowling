import { IUser } from '@/Interfaces/interfaces';
import Model from '@/Models/Model';

export default class User extends Model implements IUser {
  public id?: number;
  public first_name = '';
  public last_name = '';
  public email = '';

  constructor(params: IUser) {
    super();

    this.id = params.id;
    this.first_name = params.first_name;
    this.last_name = params.last_name;
    this.email = params.email;
  }
}
