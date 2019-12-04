import Model from "@/models/Model";

export default interface BuilderInterface {
  generate(): Model;
}
